<?php
/**
 * Template library templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<script type="text/template" id="template-exad-templateLibrary-header-logo">
	<img src="<?php echo EXAD_ASSETS_URL . 'img/main-logo.svg'; ?>" alt="Main Logo">
</script>

<script type="text/template" id="template-exad-templateLibrary-header-back">
	<i class="eicon-" aria-hidden="true"></i>
	<span><?php echo __( 'Back to Library', 'exclusive-addons-elemntor' ); ?></span>
</script>

<script type="text/template" id="template-exad-TemplateLibrary_header-menu">
	<# _.each( tabs, function( args, tab ) { var activeClass = args.active ? 'elementor-active' : ''; #>
		<div class="elementor-component-tab elementor-template-library-menu-item {{activeClass}}" data-tab="{{{ tab }}}">{{{ args.title }}}</div>
	<# } ); #>
</script>

<script type="text/template" id="template-exad-templateLibrary-header-actions">
	<div id="exad-templateLibrary-header-sync" class="elementor-templates-modal__header__item">
		<i class="eicon-sync" aria-hidden="true" title="<?php esc_attr_e( 'Sync Library', 'exclusive-addons-elemntor' ); ?>"></i>
		<span class="elementor-screen-only"><?php esc_html_e( 'Sync Library', 'exclusive-addons-elemntor' ); ?></span>
	</div>
</script>

<script type="text/template" id="template-exad-templateLibrary-preview">
    <iframe></iframe>
</script>

<script type="text/template" id="template-exad-templateLibrary-header-insert">
	<div id="elementor-template-library-header-preview-insert-wrapper" class="elementor-templates-modal__header__item">
		{{{ exad.library.getModal().getTemplateActionButton( obj ) }}}
	</div>
</script>

<script type="text/template" id="template-exad-templateLibrary-insert-button">
	<a class="elementor-template-library-template-action elementor-button exad-templateLibrary-insert-button">
		<i class="eicon-file-download" aria-hidden="true"></i>
		<span class="elementor-button-title"><?php esc_html_e( 'Insert', 'exclusive-addons-elemntor' ); ?></span>
	</a>
</script>

<script type="text/template" id="template-exad-templateLibrary-pro-button">
	<a class="elementor-template-library-template-action elementor-button exad-templateLibrary-pro-button" href="https://exclusiveaddons.com/pricing/" target="_blank">
		<i class="eicon-external-link-square" aria-hidden="true"></i>
		<span class="elementor-button-title"><?php esc_html_e( 'Get Pro', 'exclusive-addons-elemntor' ); ?></span>
	</a>
</script>

<script type="text/template" id="template-exad-templateLibrary-loading">
	<div class="elementor-loader-wrapper">
		<div class="elementor-loader">
			<div class="elementor-loader-boxes">
				<div class="elementor-loader-box"></div>
				<div class="elementor-loader-box"></div>
				<div class="elementor-loader-box"></div>
				<div class="elementor-loader-box"></div>
			</div>
		</div>
		<div class="elementor-loading-title"><?php esc_html_e( 'Loading', 'exclusive-addons-elemntor' ); ?></div>
	</div>
</script>

<script type="text/template" id="template-exad-templateLibrary-templates">
	<div id="exad-templateLibrary-toolbar">
		<div id="exad-templateLibrary-toolbar-filter" class="exad-templateLibrary-toolbar-filter">
			<# if ( exad.library.getTypeCategory() ) { #>
	
				<select id="exad-templateLibrary-filter-category" class="exad-templateLibrary-filter-category">
					<option class="exad-templateLibrary-category-filter-item active" value="" data-tag=""><?php esc_html_e( 'Filter', 'exclusive-addons-elemntor' ); ?></option>
					<# _.each( exad.library.getTypeCategory(), function( slug ) { #>
						<option class="exad-templateLibrary-category-filter-item" value="{{ slug }}" data-tag="{{ slug }}">{{{ exad.library.getCategory()[slug] }}}</option>
					<# } ); #>
				</select>
			<# } #>
		</div>

		<div id="exad-templateLibrary-toolbar-search">
			<label for="exad-templateLibrary-search" class="elementor-screen-only"><?php esc_html_e( 'Search Templates:', 'exclusive-addons-elemntor' ); ?></label>
			<input id="exad-templateLibrary-search" placeholder="<?php esc_attr_e( 'Search', 'exclusive-addons-elemntor' ); ?>">
			<i class="eicon-search"></i>
		</div>
	</div>

	<div class="exad-templateLibrary-templates-window">
		<div id="exad-templateLibrary-templates-list"></div>
	</div>
</script>

<script type="text/template" id="template-exad-templateLibrary-template">
	<div class="exad-templateLibrary-template-body" id="exad-template-{{ template_id }}">
		<div class="exad-templateLibrary-template-preview">
			<i class="eicon-zoom-in-bold" aria-hidden="true"></i>
		</div>
		<img class="exad-templateLibrary-template-thumbnail" src="{{ thumbnail }}">
		<div class="exad-templateLibrary-template-title">
			<span>{{{ title }}}</span>
		</div>
	</div>
	<div class="exad-templateLibrary-template-footer">
		{{{ exad.library.getModal().getTemplateActionButton( obj ) }}}
		<a href="#" class="elementor-button exad-templateLibrary-preview-button">
			<i class="eicon-device-desktop" aria-hidden="true"></i>
			<?php esc_html_e( 'Preview', 'exclusive-addons-elemntor' ); ?>
		</a>
	</div>
</script>

<script type="text/template" id="template-exad-templateLibrary-empty">
	<div class="elementor-template-library-blank-icon">
		<i class="eicon-search-results"></i>
	</div>
	<div class="elementor-template-library-blank-title"></div>
	<div class="elementor-template-library-blank-message"></div>
	<div class="elementor-template-library-blank-footer">
		<?php esc_html_e( 'Want to learn more about the Exclusive Addons?', 'exclusive-addons-elemntor' ); ?>
		<a class="elementor-template-library-blank-footer-link" href="https://exclusiveaddons.com/" target="_blank"><?php echo __( 'Click here', 'exclusive-addons-elementor' ); ?></a>
	</div>
</script>
