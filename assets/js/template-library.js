!(function (e, t) {
    window.exad = window.exad || {};

    exad.translate = function (e, t) {
        return elementorCommon.translate(e, null, t, ExclusiveAddonsEditor.i18n);
    }

    var i = {
        Views: {},
        Models: {},
        Collections: {},
        Behaviors: {},
        Layout: null,
        Manager: null
    };
    (i.Models.Template = Backbone.Model.extend({
        defaults: {
            template_id: 0,
            title: "",
            type: "",
            thumbnail: "",
            url: "",
            category: []
        }
    })),
    (i.Collections.Template = Backbone.Collection.extend({
        model: i.Models.Template
    })),
    (i.Behaviors.InsertTemplate = Marionette.Behavior.extend({
        ui: {
            insertButton: ".exad-templateLibrary-insert-button"
        },
        events: {
            "click @ui.insertButton": "onInsertButtonClick"
        },
        onInsertButtonClick: function () {
            exad.library.insertTemplate({
                model: this.view.model
            });
        },
    })),
    (i.Views.EmptyTemplateCollection = Marionette.ItemView.extend({
        id: "elementor-template-library-templates-empty",
        template: "#template-exad-templateLibrary-empty",
        ui: {
            title: ".elementor-template-library-blank-title",
            message: ".elementor-template-library-blank-message"
        },
        modesStrings: {
            empty: {
                title: exad.translate("templatesEmptyTitle"),
                message: exad.translate("templatesEmptyMessage")
            },
            noResults: {
                title: exad.translate("templatesNoResultsTitle"),
                message: exad.translate("templatesNoResultsMessage")
            },
        },
        getCurrentMode: function () {
            return exad.library.getFilter("text") ? "noResults" : "empty";
        },
        onRender: function () {
            var e = this.modesStrings[this.getCurrentMode()];
            this.ui.title.html(e.title), this.ui.message.html(e.message);
        },
    })),
    (i.Views.Loading = Marionette.ItemView.extend({
        template: "#template-exad-templateLibrary-loading",
        id: "exad-templateLibrary-loading"
    })),
    (i.Views.Logo = Marionette.ItemView.extend({
        template: "#template-exad-templateLibrary-header-logo",
        className: "exad-templateLibrary-header-logo",
        templateHelpers: function () {
            return {
                title: this.getOption("title")
            };
        },
    })),
    (i.Views.BackButton = Marionette.ItemView.extend({
        template: "#template-exad-templateLibrary-header-back",
        id: "elementor-template-library-header-preview-back",
        className: "exad-templateLibrary-header-back",
        events: function () {
            return {
                click: "onClick"
            };
        },
        onClick: function () {
            exad.library.showBlocksView();
        },
    })),
    (i.Views.Actions = Marionette.ItemView.extend({
        template: "#template-exad-templateLibrary-header-actions",
        id: "elementor-template-library-header-actions",
        ui: {
            sync: "#exad-templateLibrary-header-sync i"
        },
        events: {
            "click @ui.sync": "onSyncClick"
        },
        onSyncClick: function () {
            var e = this;
            e.ui.sync.addClass("eicon-animation-spin"),
                exad.library.requestLibraryData({
                    onUpdate: function () {
                        e.ui.sync.removeClass("eicon-animation-spin"), exad.library.updateBlocksView();
                    },
                    forceUpdate: !0,
                    forceSync: !0,
                });
        },
    })),
    (i.Views.InsertWrapper = Marionette.ItemView.extend({
        template: "#template-exad-templateLibrary-header-insert",
        id: "elementor-template-library-header-preview",
        behaviors: {
            insertTemplate: {
                behaviorClass: i.Behaviors.InsertTemplate
            }
        },
    })),
    (i.Views.Preview = Marionette.ItemView.extend({
        template: "#template-exad-templateLibrary-preview",
        className: "exad-templateLibrary-preview",
        ui: function () {
            return {
                iframe: "> iframe"
            };
        },
        onRender: function () {
            this.ui.iframe.attr("src", this.getOption("url")).hide();
            var e = this,
                t = new i.Views.Loading().render();
            this.$el.append(t.el),
                this.ui.iframe.on("load", function () {
                    e.$el.find("#exad-templateLibrary-loading").remove(), e.ui.iframe.show();
                });
        },
    })),
    (i.Views.TemplateCollection = Marionette.CompositeView.extend({
        template: "#template-exad-templateLibrary-templates",
        id: "exad-templateLibrary-templates",
        childViewContainer: "#exad-templateLibrary-templates-list",
        emptyView: function () {
            return new i.Views.EmptyTemplateCollection();
        },
        ui: {
            templatesWindow: ".exad-templateLibrary-templates-window",
            textFilter: "#exad-templateLibrary-search",
            categoryFilter: "#exad-templateLibrary-filter-category",
            filterBar: "#exad-templateLibrary-toolbar-filter"
        },
        events: {
            "input @ui.textFilter": "onTextFilterInput",
            "change @ui.categoryFilter": "onCategoryFilterClick"
        },
        getChildView: function (e) {
            return i.Views.Template;
        },
        initialize: function () {
            this.listenTo(exad.library.channels.templates, "filter:change", this._renderChildren);
        },
        filter: function (e) {
            var t = exad.library.getFilterTerms(),
                i = !0;
            return (
                _.each(t, function (t, a) {
                    var n = exad.library.getFilter(a);
                    if (n && t.callback) {
                        var r = t.callback.call(e, n);
                        return r || (i = !1), r;
                    }
                }),
                i
            );
        },
        setMasonrySkin: function () {
            var e = new elementorModules.utils.Masonry({
                container: this.$childViewContainer,
                items: this.$childViewContainer.children()
            });
            this.$childViewContainer.imagesLoaded(e.run.bind(e));
        },
        onRenderCollection: function () {
            this.setMasonrySkin(), this.updatePerfectScrollbar();
        },
        onTextFilterInput: function () {
            var e = this;
            _.defer(function () {
                exad.library.setFilter("text", e.ui.textFilter.val());
            });
        },
        onCategoryFilterClick: function (t) {
            var i = t.currentTarget.selectedOptions[0].value;
            exad.library.setFilter("category", i);
        },
        updatePerfectScrollbar: function () {
            this.perfectScrollbar || (this.perfectScrollbar = new PerfectScrollbar(this.ui.templatesWindow[0], {
                suppressScrollX: !0
            })), (this.perfectScrollbar.isRtl = !1), this.perfectScrollbar.update();
        },
        onRender: function () {
            this.$("#exad-templateLibrary-filter-category").select2({ placeholder: "Filter By Widget", allowClear: !0, width: 200 }), this.updatePerfectScrollbar();
        },
    })),
    (i.Views.Template = Marionette.ItemView.extend({
        template: "#template-exad-templateLibrary-template",
        className: "exad-templateLibrary-template",
        ui: {
            previewButton: ".exad-templateLibrary-preview-button, .exad-templateLibrary-template-preview"
        },
        events: {
            "click @ui.previewButton": "onPreviewButtonClick"
        },
        behaviors: {
            insertTemplate: {
                behaviorClass: i.Behaviors.InsertTemplate
            }
        },
        onPreviewButtonClick: function () {
            exad.library.showPreviewView(this.model);
        },
    })),
    (i.Modal = elementorModules.common.views.modal.Layout.extend({
        getModalOptions: function () {
            return {
                id: "exadTemplateLibraryModal",
                hide: {
                    onOutsideClick: !1,
                    onEscKeyPress: !0,
                    onBackgroundClick: !1
                }
            };
        },
        getTemplateActionButton: function (e) {
            var t = "insert-button";
            return (viewId = "#template-exad-templateLibrary-" + t), (template = Marionette.TemplateCache.get(viewId)), Marionette.Renderer.render(template);
        },
        showLogo: function (e) {
            this.getHeaderView().logoArea.show(new i.Views.Logo(e));
        },
        showDefaultHeader: function () {
            this.showLogo({
                title: "Exclusive Addons"
            });
            var e = this.getHeaderView();
            e.tools.show(new i.Views.Actions()), e.menuArea.reset();
        },
        showPreviewView: function (e) {
            var t = this.getHeaderView();
            t.logoArea.show(new i.Views.BackButton()), t.tools.show(new i.Views.InsertWrapper({
                model: e
            })), 
            this.modalContent.show(new i.Views.Preview({
                url: e.get("url")
            }));
        },
        showBlocksView: function (e) {
            this.modalContent.show(new i.Views.TemplateCollection({
                collection: e
            }));
        },
    })),
    (i.Manager = function () {
        function a() {
            var t = e(this).closest(".elementor-top-section"),
                i = t.data("model-cid"),
                a = window.elementor.sections;
            a.currentView.collection.length &&
                _.each(a.currentView.collection.models, function (e, t) {
                    i === e.cid && (m.atIndex = t);
                }),
                t.prev(".elementor-add-section").find(FIND_SELECTOR).before($exadLibraryButton);
        }

        function n(e) {
            var t = e.find(FIND_SELECTOR);
            t.length && t.before($exadLibraryButton), e.on("click.onAddElement", ".elementor-editor-section-settings .elementor-editor-element-add", a);
        }

        function r(t, i) {
            i.addClass("elementor-active").siblings().removeClass("elementor-active");
            var a = devicesResponsiveMap[t] || devicesResponsiveMap.desktop;
            e(".exad-templateLibrary-preview").css("width", a);
        }

        function o() {
            var e = window.elementor.$previewContents,
                t = setInterval(function () {
                    n(e), e.find(".elementor-add-new-section").length > 0 && clearInterval(t);
                }, 100);
            e.on("click.onAddTemplateButton", ".elementor-add-exad-button", m.showModal.bind(m)), this.channels.tabs.on("change:device", r);
        }
        var l,
            s,
            d,
            c,
            m = this;
        (FIND_SELECTOR = ".elementor-add-new-section .elementor-add-section-drag-title"),
        ($exadLibraryButton = '<div class="elementor-add-section-area-button elementor-add-exad-button"><i class="exad exad-logo"></i></div>'),
        (devicesResponsiveMap = {
            desktop: "100%",
            tab: "768px",
            mobile: "360px"
        }),
        (this.atIndex = -1),
        (this.channels = {
            tabs: Backbone.Radio.channel("tabs"),
            templates: Backbone.Radio.channel("templates")
        }),
        (this.updateBlocksView = function () {
            m.setFilter("category", "", !0), m.setFilter("text", "", !0), m.getModal().showBlocksView(d);
        }),
        (this.setFilter = function (e, t, i) {
            m.channels.templates.reply("filter:" + e, t), i || m.channels.templates.trigger("filter:change");
        }),
        (this.getFilter = function (e) {
            return m.channels.templates.request("filter:" + e);
        }),
        (this.getFilterTerms = function () {
            return {
                category: {
                    callback: function (e) {
                        return _.any(this.get("category"), function (t) {
                            return t.indexOf(e) >= 0;
                        });
                    },
                },
                text: {
                    callback: function (e) {
                        return (
                            (e = e.toLowerCase()),
                            this.get("title").toLowerCase().indexOf(e) >= 0 ||
                            _.any(this.get("category"), function (t) {
                                return t.indexOf(e) >= 0;
                            })
                        );
                    },
                },
            };
        }),
        (this.showModal = function () {
            m.getModal().showModal(), m.showBlocksView();
        }),
        (this.closeModal = function () {
            this.getModal().hideModal();
        }),
        (this.getModal = function () {
            return l || (l = new i.Modal()), l;
        }),
        (this.init = function () {
            t.on("preview:loaded", o.bind(this));
        }),
        (this.getCategory = function () {
            return s;
        }),
        (this.showBlocksView = function () {
            m.getModal().showDefaultHeader(),
                m.setFilter("category", "", !0),
                m.setFilter("category", "", !0),
                m.loadTemplates(function () {
                    m.getModal().showBlocksView(d);
                });
        }),
        (this.showPreviewView = function (e) {
            m.getModal().showPreviewView(e);
        }),
        (this.loadTemplates = function (e) {
            m.requestLibraryData({
                onBeforeUpdate: m.getModal().showLoadingView.bind(m.getModal()),
                onUpdate: function () {
                    m.getModal().hideLoadingView(), e && e();
                },
            });
        }),
        (this.requestLibraryData = function (e) {
            if (d && !e.forceUpdate) return void(e.onUpdate && e.onUpdate());
            e.onBeforeUpdate && e.onBeforeUpdate();
            var t = {
                data: {},
                success: function (t) {
                    (d = new i.Collections.Template(t.templates)), t.category && (s = t.category), e.onUpdate && e.onUpdate();
                },
            };
            e.forceSync && (t.data.sync = !0), elementorCommon.ajax.addRequest("exad_get_template_library_data", t);
        }),
        (this.requestTemplateData = function (e, t) {
            var i = {
                unique_id: e,
                data: {
                    edit_mode: !0,
                    display: !0,
                    template_id: e
                }
            };
            t && jQuery.extend(!0, i, t), elementorCommon.ajax.addRequest("exad_get_template_item_data", i);
        }),
        (this.insertTemplate = function (e) {
            var t = e.model,
                i = this;
            i.getModal().showLoadingView(),
                i.requestTemplateData(t.get("template_id"), {
                    success: function (e) {
                        i.getModal().hideLoadingView(), i.getModal().hideModal();
                        var a = {}; -
                        1 !== i.atIndex && (a.at = i.atIndex), $e.run("document/elements/import", {
                            model: t,
                            data: e,
                            options: a
                        }), (i.atIndex = -1);
                    },
                    error: function (e) {
                        i.showErrorDialog(e);
                    },
                    complete: function (e) {
                        i.getModal().hideLoadingView();
                    },
                });
        }),
        (this.showErrorDialog = function (e) {
            if ("object" == typeof e) {
                var t = "";
                _.each(e, function (e) {
                        t += "<div>" + e.message + ".</div>";
                    }),
                    (e = t);
            } else e ? (e += ".") : (e = "<i>&#60;The error message is empty&#62;</i>");
            m.getErrorDialog()
                .setMessage('The following error(s) occurred while processing the request:<div id="elementor-template-library-error-info">' + e + "</div>")
                .show();
        }),
        (this.getErrorDialog = function () {
            return c || (c = elementorCommon.dialogsManager.createWidget("alert", {
                id: "elementor-template-library-error-dialog",
                headerMessage: "An error occurred"
            })), c;
        });
    }),
    (window.exad.library = new i.Manager()),
    window.exad.library.init();
})(jQuery, window.elementor);