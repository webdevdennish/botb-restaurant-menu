<?php 

/**
 * TODO
 * 
 * Get it into the backbone rendering
 * 
 * Background image for header
 * Divider under header
 * 
 */
namespace Beat_on_the_Brat_Plugins;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Beat_on_the_Brat_Schedule extends \Elementor\Widget_Base {

#region getters
    public function get_name() {
        return 'beatonthebrat-menu';
    }

	public function get_title() {
        return 'Beat on the Brat Menu';
    }

	public function get_icon() {
        //https://elementor.github.io/elementor-icons/
        return 'eicon-table';
    }

	public function get_custom_help_url() {
        return 'https://www.google.com';
    }

	public function get_categories() {
        return ['beatonthebrat-category','basic', 'favorites'];
    }

	public function get_keywords(){
        return ['beatonthebrat', 'addon', 'menu', 'table'];
    }

	public function get_script_depends() {
        
        // wp_register_script( string $handle, string|bool $src, string[] $deps = array(), string|bool|null $ver = false, bool $in_footer = false )
		wp_register_script( 'menu-script', BEATONTHEBRAT_PLUGIN_URL . 'assets/js/menu.js',array( 'jquery', 'elementor-frontend' ), '', true  );

		return [
			'menu-script',
		];

	}

	public function get_style_depends() {


		wp_register_style( 'menu-style', BEATONTHEBRAT_PLUGIN_URL . 'assets/css/menu.css');
		

		return [
			'menu-style',
		];
    }

#endregion

#region register controls
	protected function register_controls() {


		$this->start_controls_section(
			'header_section',
			[
				'label' => esc_html__( 'Header', 'beatonthebrat-plugins' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'Title', 'beatonthebrat-plugins' ),
				'placeholder' => esc_html__( 'Enter your title', 'beatonthebrat-plugins' ),
				'default' => 'Title',
			]
		);

		$this->add_control(
			'subtitle',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'Subtitle', 'beatonthebrat-plugins' ),
				'placeholder' => esc_html__( 'Enter your subtitle', 'beatonthebrat-plugins' ),
				'default' => 'Subtitle'
			]
		);


		$this->add_control(
			'amount_1',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'Quantity 1', 'beatonthebrat-plugins' ),
				'placeholder' => esc_html__( 'Enter your first quantity', 'beatonthebrat-plugins' ),
			]
		);


		$this->add_control(
			'amount_2',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'Quantity 2', 'beatonthebrat-plugins' ),
				'placeholder' => esc_html__( 'Enter your second quantity', 'beatonthebrat-plugins' ),
			]
		);


		$this->add_control(
			'amount_1_currency',
			[
				'label' => esc_html__( 'Price 1 Currency', 'beatonthebrat-plugins' ),
				'type' => 'currency',
			]
		);

		$this->add_control(
			'amount_2_currency',
			[
				'label' => esc_html__( 'Price 2 Currency ', 'beatonthebrat-plugins' ),
				'type' => 'currency',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'items_section',
			[
				'label' => esc_html__( 'Menu Items', 'beatonthebrat-plugins' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		/**
		 * Start repeater
		 */

		$menu_item_repeater = new \Elementor\Repeater();



		$menu_item_repeater->add_control(
			'item_name', [
				'label' => esc_html__( 'Name', 'beatonthebrat-plugins' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter the item name', 'beatonthebrat-plugins' ),
			]
		);

		$menu_item_repeater->add_control(
			'item_description', [
				'label' => esc_html__( 'Description', 'beatonthebrat-plugins' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter the item description', 'beatonthebrat-plugins' ),
			]
		);

		$menu_item_repeater->add_control(
			'item_price_1', [
				'label' => esc_html__( 'First price', 'beatonthebrat-plugins' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'placeholder' => esc_html__( 'Enter the first item price', 'beatonthebrat-plugins' ),
			]
		);

		$menu_item_repeater->add_control(
			'item_price_2', [
				'label' => esc_html__( 'Second price', 'beatonthebrat-plugins' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'placeholder' => esc_html__( 'Enter the second item price', 'beatonthebrat-plugins' ),
	
			]
		);

		$menu_item_repeater->add_control(
			'item_image', [
				'label' => esc_html__( 'Image', 'beatonthebrat-plugins' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'placeholder' => esc_html__( 'Select image', 'beatonthebrat-plugins' ),
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);


		// add the repeater as a control

		$this->add_control(
			'menu_items',
			[
				'label' => esc_html__( 'Menu Items', 'beatonthebrat-plugins' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $menu_item_repeater->get_controls(),
				'default' => [
					[
						'item_name' => esc_html__( 'Menu Item #1', 'beatonthebrat-plugins' ),
						'item_description' => esc_html__( 'Item description #1.', 'beatonthebrat-plugins' ),
					],
					[
						'item_name' => esc_html__( 'Menu Item #2', 'beatonthebrat-plugins' ),
						'item_description' => esc_html__( 'Item description #2.', 'beatonthebrat-plugins' ),
					],
				],
				'title_field' => '{{{ item_name }}}',
			]
		);


		/***
		 * end of repeater
		 */
		$this->end_controls_section();

		/**
		 * Style section
		 */


		$this->start_controls_section(
			'header_style_section',
			[
				'label' => esc_html__( 'Header Styles', 'beatonthebrat-plugins' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'header_margin',
			[
				'label' => esc_html__( 'Header Margin', 'beatonthebrat-plugins' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => ['isLinked' => false ],
				'selectors' => [
					'{{WRAPPER}} .header-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'header_padding',
			[
				'label' => esc_html__( 'Header Padding', 'beatonthebrat-plugins' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => ['isLinked' => false ],
				'selectors' => [
					'{{WRAPPER}} .header-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'titles_css_spacing',
			[
				'label' => esc_html__( 'Titles spacing ', 'beatonthebrat-plugins' ),
				'type' => 'css_spacing',
				'selectors' => [
					'{{WRAPPER}} .title-wrapper' => 'justify-content: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'header_border',
				'label' => esc_html__( 'Border', 'beatonthebrat-plugins' ),
				'selector' => '{{WRAPPER}} .header-wrapper',
			]
		);

		$this->add_control(
			'title_options',
			[
				'label' => esc_html__( 'Title', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Font', 'beatonthebrat-plugins' ),
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .title',
			]
		);


		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Font Color', 'beatonthebrat-plugins' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}}',
				],
			]
		);




		$this->add_control(
			'subtitle_options',
			[
				'label' => esc_html__( 'Subtitle', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Font', 'beatonthebrat-plugins' ),
				'name' => 'subtitle_typography',
				'selector' => '{{WRAPPER}} .subtitle',
			]
		);


		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__( 'Font Color', 'beatonthebrat-plugins' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .subtitle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'amount_options',
			[
				'label' => esc_html__( 'Quantity', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Font', 'beatonthebrat-plugins' ),
				'name' => 'amount_typography',
				'selector' => '{{WRAPPER}} .amount',
			]
		);


		$this->add_control(
			'amount_color',
			[
				'label' => esc_html__( 'Font Color', 'beatonthebrat-plugins' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .amount' => 'color: {{VALUE}}',
				],
			]
		);



// https://developers.elementor.com/docs/controls/classes/control-dimensions/


		$this->end_controls_section();


		$this->start_controls_section(
			'item_style_section',
			[
				'label' => esc_html__( 'Item Style', 'beatonthebrat-plugins' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'item_name_options',
			[
				'label' => esc_html__( 'Item Name', 'beatonthebrat-plugins' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Font', 'beatonthebrat-plugins' ),
				'name' => 'item_name_typography',
				'selector' => '{{WRAPPER}} .item-name',
			]
		);


		$this->add_control(
			'item_name_color',
			[
				'label' => esc_html__( 'Font Color', 'beatonthebrat-plugins' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'item_descriptions_options',
			[
				'label' => esc_html__( 'Item Description', 'beatonthebrat-plugins' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Font', 'beatonthebrat-plugins' ),
				'name' => 'item_decription_typography',
				'selector' => '{{WRAPPER}} .item-description',
			]
		);


		$this->add_control(
			'item_description_color',
			[
				'label' => esc_html__( 'Font Color', 'beatonthebrat-plugins' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item-description' => 'color: {{VALUE}}',
				],
			]
		);


		/**
		 * Xitem_name
		 * Xitem_description
		 * price_1
		 * price_2
		 * item_divider
		 */

		$this->end_controls_section();

		$this->start_controls_section(
			'item_image_style_section',
			[
				'label' => esc_html__( 'Image Style', 'beatonthebrat-plugins' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_image_dimension',
			[
				'label' => esc_html__( 'Image container size', 'beatonthebrat-plugins' ),
				'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
				'show_label' => true,
				'description' => esc_html__( 'The image scales to the largest possible, centered inside the container.', 'plugin-name' ),
				'default' => [
					'width' => '80',
					'height' => '60',
				],
			]
		);

		$this->end_controls_section();


	}

#endregion


	protected function render() {

		$settings = $this->get_settings_for_display();
		$objId = spl_object_id($this); //https://www.php.net/manual/en/function.spl-object-id.php


#region check values
	
	

		$title_class = strlen($settings['title']) ? '' : ' no-display';
		$subtitle_class = strlen($settings['subtitle']) ? '' : ' no-display';
		$amount_1_class = strlen($settings['amount_1']) ? '' : ' no-display';
		$amount_2_class = strlen($settings['amount_2']) ? '' : ' no-display';

#endregion

#region add attributes
		
		$this->add_render_attribute(
			'category-wrapper',
			[
				'id' => 'cat-' . $objId,
				'class' => 'category-wrapper',
			]
		);

	



		$this->add_render_attribute( 'category-wrapper', 'class', 'category-wrapper', true );
		$this->add_render_attribute( 'header-wrapper', 'class', 'header-wrapper', true );
		$this->add_render_attribute( 'title-wrapper', 'class', 'title-wrapper', true );
		$this->add_render_attribute( 'amount-wrapper', 'class', 'amount-wrapper');
		
		$this->add_render_attribute( 'title', 'class', 'title' . $title_class, false );
		$this->add_inline_editing_attributes( 'title', 'none' ); //none, basic, advanced

		$this->add_render_attribute( 'subtitle', 'class', 'subtitle' . $subtitle_class, false );
		$this->add_inline_editing_attributes( 'subtitle', 'none' ); //none, basic, advanced


		$this->add_render_attribute( 'amount_1', 'class', 'amount amount-1' . $amount_1_class, false );
		$this->add_inline_editing_attributes( 'amount_1', 'none' ); //none, basic, advanced


		$this->add_render_attribute( 'amount_2', 'class', 'amount amount-2' . $amount_2_class, false );
		$this->add_inline_editing_attributes( 'amount_2', 'none' ); //none, basic, advanced


		$this->add_render_attribute( 'items-wrapper', 'class', 'items-wrapper', false );
		

		$this->add_render_attribute( 'item-left-wrapper', 'class', 'item-left-wrapper', false );
		$this->add_render_attribute( 'item-info-wrapper', 'class', 'item-info-wrapper', false );
		$this->add_render_attribute( 'item-info-wrapper', 'class', 'item-info-wrapper', false );




		$this->add_render_attribute( 'item-price-wrapper', 'class', 'item-price-wrapper', false );



#endregion


		?>
		
		<div <?php echo $this->get_render_attribute_string( 'category-wrapper' ); ?> >
			<div <?php echo $this->get_render_attribute_string( 'header-wrapper' ); ?> >
				<div <?php echo $this->get_render_attribute_string( 'title-wrapper' ); ?> >
					<div <?php echo $this->get_render_attribute_string( 'title' ) ?>> <?php echo $settings['title'] ?></div>
					<div <?php echo $this->get_render_attribute_string( 'subtitle' ) ?>> <?php echo $settings['subtitle'] ?></div>
				</div>
				<div <?php echo $this->get_render_attribute_string( 'amount-wrapper' ); ?> >
					<div <?php echo $this->get_render_attribute_string( 'amount_1' ) ?>> <?php echo $settings['amount_1'] ?></div>
					<div <?php echo $this->get_render_attribute_string( 'amount_2' ) ?>> <?php echo $settings['amount_2'] ?></div>
				</div>
			</div>


			<!-- INSERT REPEATER HERE -->
			<div <?php echo $this->get_render_attribute_string( 'items-wrapper' ); ?> >

				<?php 
				$nr = 1;

				foreach ( $settings['menu_items'] as $index => $item ):

					// get a number for the item
					$this->remove_render_attribute( 'item_wrapper' ); // fix potential elementor bug
					$this->add_render_attribute( 'item_wrapper', 'class', 'elementor-repeater-item-' . $item['_id'] . ' item-wrapper item-' .  $nr, true );


					/**
					 * CHECK FOR EMPTY VALUES
					 */
		
#region image					 
					$hasImage = wp_attachment_is_image($item['item_image']['id']);
					
					if($hasImage){

						$tmb = wp_get_attachment_image_src( $item['item_image']['id'], 'thumbnail' );
						$img =  wp_get_attachment_image_src( $item['item_image']['id'], 'full' );
						$item_img_width = $settings['item_image_dimension']['width'];
						$item_img_height = $settings['item_image_dimension']['height'];
						$this->add_render_attribute( 'item-image-wrapper', 'class', 'item-image-wrapper', true );

						//$this->add_render_attribute( 'item-image', 'id', $objId . '-tmb-' . $nr, true);
						//$this->add_render_attribute( 'item-image', 'src', $tmb[0], true);

						// $this->add_render_attribute( 'item-image', 'width', $item_img_width, true);
						// $this->add_render_attribute( 'item-image', 'height', $item_img_height, true);
						$this->add_render_attribute( 'item-image', 'title', \Elementor\Control_Media::get_image_title( $item['item_image'] ), true );
						$this->add_render_attribute( 'item-image', 'class', 'item-image', true );
					
					}
#endregion

					$item_name_class = strlen($item['item_name']) ? '' : ' no-display';
					$item_description_class = strlen($item['item_description']) ? '' : ' no-display';
					$item_price_1_class = strlen($item['item_price_1']) ? '' : ' no-display';
					$item_price_2_class = strlen($item['item_price_2']) ? '' : ' no-display';


					
					$item_name_setting_key = $this->get_repeater_setting_key( 'item_name', 'menu_items', $index );
					$this->add_render_attribute( $item_name_setting_key, 'class', 'item-name' . $item_name_class, true );
					$this->add_inline_editing_attributes( $item_name_setting_key, 'none' ); //none, basic, advanced
			
					
					$item_description_setting_key = $this->get_repeater_setting_key( 'item_description', 'menu_items', $index );
					$this->add_render_attribute( $item_description_setting_key, 'class', 'item-description' . $item_description_class, true );
					$this->add_inline_editing_attributes( $item_description_setting_key, 'none' ); //none, basic, advanced

					$item_price_1_setting_key = $this->get_repeater_setting_key( 'item_price_1', 'menu_items', $index );
					$this->add_render_attribute( $item_price_1_setting_key, 'class', 'item-price item-price-1' . $item_price_1_class, true );
					$this->add_inline_editing_attributes( $item_price_1_setting_key, 'none' ); //none, basic, advanced
					
					$item_price_2_setting_key = $this->get_repeater_setting_key( 'item_price_2', 'menu_items', $index );
					$this->add_render_attribute( $item_price_2_setting_key, 'class', 'item-price item-price-2' . $item_price_2_class, true );
					$this->add_inline_editing_attributes( $item_price_2_setting_key, 'none' ); //none, basic, advanced




				?>
				<div <?php echo $this->get_render_attribute_string( 'item_wrapper' ); ?> >
					<div <?php echo $this->get_render_attribute_string( 'item-left-wrapper' ); ?> >


						<?php if(false): ?>
							<div <?php echo $this->get_render_attribute_string( 'item-image-wrapper' ); ?> >
								<a href="#<?php echo $objId . '-img-' . $nr ?>">
								<img <?php 
									//*************************** */
									// CHANGE TO BACKGROUND IMAGE
										// check for image
										echo $this->get_render_attribute_string( 'item_image' ); ?> /></a>
								<a href="#" class="menu-lightbox" id="<?php echo $objId . '-img-' . $nr ?>">
									<span style="background-image: url('<?php echo $img[0] ?>')"></span>
								</a>
							</div>
						<?php endif ?>	



						<?php if($hasImage): ?>
							<div <?php echo $this->get_render_attribute_string( 'item-image-wrapper' ); ?> >
								<a href="#<?php echo $objId . '-img-' . $nr ?>" <?php echo $this->get_render_attribute_string( 'item-image' ); ?> style="background-image: url('<?php echo $tmb[0] ?>'); padding-bottom:<?php echo $item_img_height ?>px; padding-right:<?php echo $item_img_width ?>px;"></a>
								<a href="#" class="menu-lightbox" id="<?php echo $objId . '-img-' . $nr ?>">
									<span style="background-image: url('<?php echo $img[0] ?>')"></span>
								</a>
							</div>
						<?php endif ?>	
						<div <?php echo $this->get_render_attribute_string( 'item-info-wrapper' ); ?> >
							<div <?php echo $this->get_render_attribute_string( $item_name_setting_key ) ?>> 
								<?php echo $item['item_name'] ?>
							</div>
							<div <?php echo $this->get_render_attribute_string( $item_description_setting_key ) ?>> <?php echo $item['item_description'] ?></div>
						</div>
					</div>
					<div <?php echo $this->get_render_attribute_string( 'item-price-wrapper' ); ?> >
						<div <?php echo $this->get_render_attribute_string( $item_price_1_setting_key ) ?>> <?php echo $settings['amount_1_currency'] . ' ' . $item['item_price_1'] ?></div>
						<div <?php echo $this->get_render_attribute_string( $item_price_2_setting_key ) ?>> <?php echo $settings['amount_2_currency'] . ' ' . $item['item_price_2'] ?></div>
					</div>
				</div>
				<?php
				$nr++;
				endforeach;
				?>
			<!-- END FOR LOOP -->
			</div>
		</div>
		<?php

    }
	protected function content_templateX() {
		

		?>

		<# 
		
	
		var title_class = settings.title.length ? '' : ' no-display';
		var subtitle_class = settings.subtitle.length ? '' : ' no-display';
		var amount_1_class = settings.amount_1.length ? '' : ' no-display';
		var amount_2_class = settings.amount_2.length ? '' : ' no-display';

		view.addRenderAttribute('title', 'class', 'title' + title_class );
		view.addRenderAttribute('subtitle', 'class', 'subtitle' + subtitle_class );
		view.addRenderAttribute('amount_1', 'class', 'amount_1' + amount_1_class );
		view.addRenderAttribute('amount_2', 'class', 'amount_2' + amount_2_class );

		view.addInlineEditingAttributes( 'title' );
		view.addInlineEditingAttributes( 'subtitle' );
		view.addInlineEditingAttributes( 'amount_1' );
		view.addInlineEditingAttributes( 'amount_2' );


		#>
		
		
		<div {{{ view.getRenderAttributeString( 'category-wrapper' }}}>
			<div {{{ view.getRenderAttributeString( 'header-wrapper' }}}>
				<div {{{ view.getRenderAttributeString( 'title-wrapper' }}}>

					<div {{{ view.getRenderAttributeString( 'title' ) }}}>XX{{{ settings.title }}}</div>
					<div {{{ view.getRenderAttributeString( 'subtitle' ) }}}>XX{{{ settings.subtitle }}}</div>
				</div> <!-- end title-wrapper-->
				<div {{{ view.getRenderAttributeString( 'amount-wrapper' }}}>
				<div {{{ view.getRenderAttributeString( 'amount_1' ) }}}>XX{{{ settings.amount_1 }}}</div>
				<div {{{ view.getRenderAttributeString( 'amount_2' ) }}}>XX{{{ settings.amount_2 }}}</div>
				</div><!-- end amount-wrapper-->
			</div><!-- end header-wrapper-->
		
		
		<#
		// start loop
		_.each( settings.items, function( item ) { #>
			view.addRenderAttribute('title', 'class', 'title');
			view.addInlineEditingAttributes( 'title', 'none' );

			view.addRenderAttribute('subtitle', 'class', 'subtitle');
			view.addInlineEditingAttributes( 'subtitle', 'none' 
				<div class="elementor-repeater-item-{{ item._id }}">{{{ item.title }}}</div>
				<div>{{{ item.subtitle }}}</div>
		<# }); //end loop
			#>



		</div> <!-- end category-wrapper -->
		<?php
	}


}



//************************************************ */