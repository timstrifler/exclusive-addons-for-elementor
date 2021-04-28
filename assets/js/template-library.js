!function($, me, self) {
  /**
   * @param {string} value
   * @param {!Object} position
   * @return {?}
   */
  self.translate = function(value, position) {
    return elementorCommon.translate(value, null, position, ExclusiveAddonsEditor.i18n);
  };

  FIND_SELECTOR = ".elementor-add-new-section .elementor-add-section-drag-title";

  var root = {
    LibraryViews : {},
    LibraryModels : {},
    LibraryCollections : {},
    LibraryBehaviors : {},
    LibraryLayout : null,
    LibraryManager : null
  };
  root.LibraryModels.Template = Backbone.Model.extend({
    defaults : {
      template_id : 0,
      title : "",
      type : "",
      thumbnail : "",
      url : "",
      isPro : false,
      category : []
    }
  });
  root.LibraryCollections.Template = Backbone.Collection.extend({
    model : root.LibraryModels.Template
  });
  root.LibraryBehaviors.InsertTemplate = Marionette.Behavior.extend({
    ui : {
      insertButton : ".exad-templateLibrary-insert-button"
    },
    events : {
      "click @ui.insertButton" : "onInsertButtonClick"
    },
    onInsertButtonClick : function() {
      self.library.insertTemplate({
        model : this.view.model
      });
    }
  });
  root.LibraryViews.Loading = Marionette.ItemView.extend({
    template : "#template-exad-templateLibrary-loading",
    id : "exad-templateLibrary-loading"
  });
  root.LibraryViews.Logo = Marionette.ItemView.extend({
    template : "#template-exad-templateLibrary-header-logo",
    className : "exad-templateLibrary-header-logo",
    templateHelpers : function() {
      return {
        title : this.getOption("title")
      };
    }
  });
  root.LibraryViews.BackButton = Marionette.ItemView.extend({
    template : "#template-exad-templateLibrary-header-back",
    id : "elementor-template-library-header-preview-back",
    className : "exad-templateLibrary-header-back",
    events : function() {
      return {
        click : "onClick"
      };
    },
    onClick : function() {
      self.library.showTemplatesView();
    }
  });
  root.LibraryViews.Menu = Marionette.ItemView.extend({
    template : "#template-exad-TemplateLibrary_header-menu",
    id : "elementor-template-library-header-menu",
    className : "exad-TemplateLibrary_header-menu",
    templateHelpers : function() {
      return self.library.getTabs();
    },
    ui : {
      menuItem : ".elementor-template-library-menu-item"
    },
    events : {
      "click @ui.menuItem" : "onMenuItemClick"
    },
    onMenuItemClick : function(event) {
      self.library.setFilter("category", "");
      self.library.setFilter("text", "");
      self.library.setFilter("type", event.currentTarget.dataset.tab, true);
      self.library.showTemplatesView();
    }
  });
  root.LibraryViews.EmptyTemplateCollection = Marionette.ItemView.extend({
    id : "elementor-template-library-templates-empty",
    template : "#template-exad-templateLibrary-empty",
    ui : {
      title : ".elementor-template-library-blank-title",
      message : ".elementor-template-library-blank-message"
    },
    modesStrings : {
      empty : {
        title : self.translate("templatesEmptyTitle"),
        message : self.translate("templatesEmptyMessage")
      },
      noResults : {
        title : self.translate("templatesNoResultsTitle"),
        message : self.translate("templatesNoResultsMessage")
      }
    },
    getCurrentMode : function() {
      return self.library.getFilter("text") ? "noResults" : "empty";
    },
    onRender : function() {
      var e = this.modesStrings[this.getCurrentMode()];
      this.ui.title.html(e.title);
      this.ui.message.html(e.message);
    }
  });
  root.LibraryViews.Actions = Marionette.ItemView.extend({
    template : "#template-exad-templateLibrary-header-actions",
    id : "elementor-template-library-header-actions",
    ui : {
      sync : "#exad-templateLibrary-header-sync i"
    },
    events : {
      "click @ui.sync" : "onSyncClick"
    },
    onSyncClick : function() {
      var $ = this;
      $.ui.sync.addClass("eicon-animation-spin");
      self.library.requestLibraryData({
        onUpdate : function() {
          $.ui.sync.removeClass("eicon-animation-spin");
          self.library.updateBlocksView();
        },
        forceUpdate : true,
        forceSync : true
      });
    }
  });
  root.LibraryViews.InsertWrapper = Marionette.ItemView.extend({
    template : "#template-exad-templateLibrary-header-insert",
    id : "elementor-template-library-header-preview",
    behaviors : {
      insertTemplate : {
        behaviorClass : root.LibraryBehaviors.InsertTemplate
      }
    }
  });
  root.LibraryViews.Preview = Marionette.ItemView.extend({
    template : "#template-exad-templateLibrary-preview",
    className : "exad-templateLibrary-preview",
    ui : function() {
      return {
        iframe : "> iframe"
      };
    },
    onRender : function() {
      this.ui.iframe.attr("src", this.getOption("url")).hide();
      var editor = this;
      var addonView = (new root.LibraryViews.Loading).render();
      this.$el.append(addonView.el);
      this.ui.iframe.on("load", function() {
        editor.$el.find("#exad-templateLibrary-loading").remove();
        editor.ui.iframe.show();
      });
    }
  });
  root.LibraryViews.TemplateCollection = Marionette.CompositeView.extend({
    template : "#template-exad-templateLibrary-templates",
    id : "exad-templateLibrary-templates",
    childViewContainer : "#exad-templateLibrary-templates-list",
    emptyView : function() {
      return new root.LibraryViews.EmptyTemplateCollection;
    },
    ui : {
      templatesWindow : ".exad-templateLibrary-templates-window",
      textFilter : "#exad-templateLibrary-search",
      categoryFilter : "#exad-templateLibrary-filter-category",
      filterBar : "#exad-templateLibrary-toolbar-filter"
    },
    events : {
      "input @ui.textFilter" : "onTextFilterInput",
      "change @ui.categoryFilter" : "onCategoryFilterClick"
    },
    getChildView : function(name) {
      return root.LibraryViews.Template;
    },
    initialize : function() {
      this.listenTo(self.library.channels.templates, "filter:change", this._renderChildren);
    },
    filter : function(selector) {
      var style = self.library.getFilterTerms();
      /** @type {boolean} */
      var $ = true;
      return _.each(style, function(opts, name) {
        var cb = self.library.getFilter(name);
        if (cb && opts.callback) {
          var after = opts.callback.call(selector, cb);
          return after || ($ = false), after;
        }
      }), $;
    },
    setMasonrySkin : function() {
      var e = new elementorModules.utils.Masonry({
        container : this.$childViewContainer,
        items : this.$childViewContainer.children()
      });
      this.$childViewContainer.imagesLoaded(e.run.bind(e));
    },
    onRenderCollection : function() {
      this.setMasonrySkin();
      this.updatePerfectScrollbar();
    },
    onTextFilterInput : function() {
      var addonInstall = this;
      _.defer(function() {
        self.library.setFilter("text", addonInstall.ui.textFilter.val());
      });
    },
    onCategoryFilterClick : function(event) {
      var value = event.currentTarget.selectedOptions[0].value;
      self.library.setFilter("category", value);
    },
    updatePerfectScrollbar : function() {
      if (!this.perfectScrollbar) {
        this.perfectScrollbar = new PerfectScrollbar(this.ui.templatesWindow[0], {
          suppressScrollX : true
        });
      }
      /** @type {boolean} */
      this.perfectScrollbar.isRtl = false;
      this.perfectScrollbar.update();
    },
    onRender : function() {
      this.$("#exad-templateLibrary-filter-category").select2({
        placeholder : "Filter",
        allowClear : true,
        width : 200
      });
      this.updatePerfectScrollbar();
    }
  });
  root.LibraryViews.Template = Marionette.ItemView.extend({
    template : "#template-exad-templateLibrary-template",
    className : "exad-templateLibrary-template",
    ui : {
      previewButton : ".exad-templateLibrary-preview-button, .exad-templateLibrary-template-preview"
    },
    events : {
      "click @ui.previewButton" : "onPreviewButtonClick"
    },
    behaviors : {
      insertTemplate : {
        behaviorClass : root.LibraryBehaviors.InsertTemplate
      }
    },
    onPreviewButtonClick : function() {
      self.library.showPreviewView(this.model);
    }
  });
  root.Modal = elementorModules.common.views.modal.Layout.extend({
    getModalOptions : function() {
      return {
        id : "exadTemplateLibraryModal",
        hide : {
          onOutsideClick : false,
          onEscKeyPress : true,
          onBackgroundClick : false
        }
      };
    },
    getTemplateActionButton : function(isPro) {
      /** @type {string} */
      var t = isPro.isPro && !ExclusiveAddonsEditor.isProActive ? "pro-button" : "insert-button";
      return viewId = "#template-exad-templateLibrary-" + t, template = Marionette.TemplateCache.get(viewId), Marionette.Renderer.render(template);
    },
    showLogo : function(callback) {
      this.getHeaderView().logoArea.show(new root.LibraryViews.Logo(callback));
    },
    showDefaultHeader : function() {
      this.showLogo({
        title : "Exclusive Addons"
      });
      var headerView = this.getHeaderView();
      headerView.tools.show(new root.LibraryViews.Actions);
      headerView.menuArea.show(new root.LibraryViews.Menu);
    },
    showPreviewView : function(templateModel) {
      var headerView = this.getHeaderView();
      headerView.logoArea.show(new root.LibraryViews.BackButton);
      headerView.tools.show(new root.LibraryViews.InsertWrapper({
        model : templateModel
      }));
      this.modalContent.show(new root.LibraryViews.Preview({
        url : templateModel.get("url")
      }));
    },
    showBlocksView : function(dbTypes) {
      this.modalContent.show(new root.LibraryViews.TemplateCollection({
        collection : dbTypes
      }));
    },
    showTemplatesView : function(templatesCollection) {
      this.showDefaultHeader();
      this.modalContent.show(new root.LibraryViews.TemplateCollection({
        collection : templatesCollection
      }));
    }
  });
  /**
   * @return {undefined}
   */
  root.LibraryManager = function() {
    /**
     * @return {undefined}
     */
    function init() {
      var n = $(this).closest(".elementor-top-section");
      var holder = n.data("id");
      var trackers = me.documents.getCurrent().container.children;
      var filteredView = n.prev(".elementor-add-section");
      if (trackers) {
        _.each(trackers, function(data, navigatorType) {
          if (holder === data.cid) {
            /** @type {string} */
            self.atIndex = navigatorType;
          }
        });
      }
      if (!filteredView.find(".elementor-add-exad-button").length) {
        filteredView.find('.elementor-add-new-section .elementor-add-section-drag-title').before($exadLibraryButton);
      }
    }
    /**
     * @param {!Object} context
     * @return {undefined}
     */
    function click(context) {
      var $ignoreReports = context.find(FIND_SELECTOR);
      if ($ignoreReports.length && !context.find(".elementor-add-exad-button").length) {
        $ignoreReports.before($exadLibraryButton);
      }
      context.on("click.onAddElement", ".elementor-editor-section-settings .elementor-editor-element-add", init);
    }
    /**
     * @param {?} options
     * @param {!Object} $trigger
     * @return {undefined}
     */
    function build(options, $trigger) {
      $trigger.addClass("elementor-active").siblings().removeClass("elementor-active");
    }
    /**
     * @return {undefined}
     */
    function render() {
      var event = window.elementor.$previewContents;
      /** @type {number} */
      var chat_retry = setInterval(function() {
        click(event);
        if (event.find(".elementor-add-new-section").length > 0) {
          clearInterval(chat_retry);
        }
      }, 100);
      event.on("click.onAddTemplateButton", ".elementor-add-exad-button", self.showModal.bind(self));
      this.channels.tabs.on("change:device", build);
    }
    var l;
    var currentCategory;
    var templatesCollection;
    var service;
    var options;
    var self = this;
    /** @type {string} */
    
    /** @type {string} */
    $exadLibraryButton = '<div class="elementor-add-section-area-button elementor-add-exad-button"><i class="exad exad-logo"></i></div>';
    /** @type {number} */
    this.atIndex = -1;
    this.channels = {
      tabs : Backbone.Radio.channel("tabs"),
      templates : Backbone.Radio.channel("templates")
    };
    /**
     * @return {undefined}
     */
    this.updateBlocksView = function() {
      self.setFilter("category", "", true);
      self.setFilter("text", "", true);
      self.getModal().showTemplatesView(templatesCollection);
    };
    /**
     * @param {string} value
     * @param {string} id
     * @param {boolean} data
     * @return {undefined}
     */
    this.setFilter = function(value, id, data) {
      self.channels.templates.reply("filter:" + value, id);
      if (!data) {
        self.channels.templates.trigger("filter:change");
      }
    };
    /**
     * @param {string} name
     * @return {?}
     */
    this.getFilter = function(name) {
      return self.channels.templates.request("filter:" + name);
    };
    /**
     * @return {?}
     */
    this.getFilterTerms = function() {
      return {
        category : {
          callback : function(e) {
            return _.any(this.get("category"), function(t) {
              return t.indexOf(e) >= 0;
            });
          }
        },
        text : {
          callback : function(e) {
            return e = e.toLowerCase(), this.get("title").toLowerCase().indexOf(e) >= 0 || _.any(this.get("category"), function(t) {
              return t.indexOf(e) >= 0;
            });
          }
        },
        type : {
          callback : function(type) {
            return this.get("type") === type;
          }
        }
      };
    };
    /**
     * @return {undefined}
     */
    this.showModal = function() {
      self.getModal().showModal();
      self.showTemplatesView();
    };
    /**
     * @return {undefined}
     */
    this.closeModal = function() {
      this.getModal().hideModal();
    };
    /**
     * @return {?}
     */
    this.getModal = function() {
      return l || (l = new root.Modal), l;
    };
    /**
     * @return {undefined}
     */
    this.init = function() {
      self.setFilter("type", "section", true);
      me.on("preview:loaded", render.bind(this));
    };
    /**
     * @return {?}
     */
    this.getTabs = function() {
      var i = this.getFilter("type");
      return tabs = {
        section : {
          title : "Blocks"
        },
        page : {
          title : "Pages"
        }
      }, _.each(tabs, function(canCreateDiscussions, categoryStart) {
        if (i === categoryStart) {
          /** @type {boolean} */
          tabs[i].active = true;
        }
      }), {
        tabs : tabs
      };
    };
    /**
     * @return {?}
     */
    this.getCategory = function() {
      return currentCategory;
    };
    /**
     * @return {?}
     */
    this.getTypeCategory = function() {
      var type = self.getFilter("type");
      return service[type];
    };
    /**
     * @return {undefined}
     */
    this.showTemplatesView = function() {
      self.setFilter("category", "", true);
      self.setFilter("text", "", true);
      if (templatesCollection) {
        self.getModal().showTemplatesView(templatesCollection);
      } else {
        self.loadTemplates(function() {
          self.getModal().showTemplatesView(templatesCollection);
        });
      }
    };
    /**
     * @param {!Object} templateModel
     * @return {undefined}
     */
    this.showPreviewView = function(templateModel) {
      self.getModal().showPreviewView(templateModel);
    };
    /**
     * @param {!Function} callback
     * @return {undefined}
     */
    this.loadTemplates = function(callback) {
      self.requestLibraryData({
        onBeforeUpdate : self.getModal().showLoadingView.bind(self.getModal()),
        onUpdate : function() {
          self.getModal().hideLoadingView();
          if (callback) {
            callback();
          }
        }
      });
    };
    /**
     * @param {!Object} options
     * @return {?}
     */
    this.requestLibraryData = function(options) {
      if (templatesCollection && !options.forceUpdate) {
        return void(options.onUpdate && options.onUpdate());
      }
      if (options.onBeforeUpdate) {
        options.onBeforeUpdate();
      }
      var data = {
        data : {},
        success : function(item) {
          templatesCollection = new root.LibraryCollections.Template(item.templates);
          if (item.category) {
            currentCategory = item.category;
          }
          if (item.type_category) {
            service = item.type_category;
          }
          if (options.onUpdate) {
            options.onUpdate();
          }
        }
      };
      if (options.forceSync) {
        /** @type {boolean} */
        data.data.sync = true;
      }
      elementorCommon.ajax.addRequest("exad_get_template_library_data", data);
    };
    /**
     * @param {string} _uid
     * @param {?} _args
     * @return {undefined}
     */
    this.requestTemplateData = function(_uid, _args) {
      var options = {
        unique_id : _uid,
        data : {
          edit_mode : true,
          display : true,
          template_id : _uid
        }
      };
      if (_args) {
        jQuery.extend(true, options, _args);
      }
      elementorCommon.ajax.addRequest("exad_get_template_item_data", options);
    };
    /**
     * @param {!Object} editor
     * @return {undefined}
     */
    this.insertTemplate = function(editor) {
      var graph = editor.model;
      var self = this;
      self.getModal().showLoadingView();
      self.requestTemplateData(graph.get("template_id"), {
        success : function(e) {
          self.getModal().hideLoadingView();
          self.getModal().hideModal();
          var a = {};
          if (-1 !== self.atIndex) {
            a.at = self.atIndex;
          }
          $e.run("document/elements/import", {
            model : graph,
            data : e,
            options : a
          });
          /** @type {number} */
          self.atIndex = -1;
        },
        error : function(data) {
          self.showErrorDialog(data);
        },
        complete : function(isCalled) {
          self.getModal().hideLoadingView();
          window.elementor.$previewContents.find(".elementor-add-section .elementor-add-section-close").click();
        }
      });
    };
    /**
     * @param {string} options
     * @return {undefined}
     */
    this.showErrorDialog = function(options) {
      if ("object" == typeof options) {
        /** @type {string} */
        var modes = "";
        _.each(options, function(origErr) {
          modes = modes + ("<div>" + origErr.message + ".</div>");
        });
        options = modes;
      } else {
        if (options) {
          /** @type {string} */
          options = options + ".";
        } else {
          /** @type {string} */
          options = "<i>&#60;The error message is empty&#62;</i>";
        }
      }
      self.getErrorDialog().setMessage('The following error(s) occurred while processing the request:<div id="elementor-template-library-error-info">' + options + "</div>").show();
    };
    /**
     * @return {?}
     */
    this.getErrorDialog = function() {
      return options || (options = elementorCommon.dialogsLibraryManager.createWidget("alert", {
        id : "elementor-template-library-error-dialog",
        headerMessage : "An error occurred"
      })), options;
    };
  };
  self.library = new root.LibraryManager;
  self.library.init();

  window.exad = self;
}(jQuery, window.elementor, window.exad || {});
