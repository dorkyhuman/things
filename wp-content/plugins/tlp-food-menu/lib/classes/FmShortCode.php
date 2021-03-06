<?php

if(!class_exists('FmShortCode')):

	/**
	*
	*/
	class FmShortCode
	{

		function __construct()
		{
			add_shortcode( 'foodmenu', array( $this, 'foodmenu_shortcode' ) );
			add_shortcode( 'foodmenu-single', array( $this, 'foodmenu_single' ) );
		}

		function foodmenu_shortcode($atts , $content = ""){

			/**
			 * Shortcode attribute desctiption
			 * @var [type]
			 */
			global $TLPfoodmenu;
			wp_enqueue_style( 'tlp-fm-css', $TLPfoodmenu->assetsUrl . 'css/tlpfoodmenu.css' );
			wp_enqueue_script( 'tlp-fm-js',  $TLPfoodmenu->assetsUrl. 'js/tlpfoodmenu.js', array('jquery'), '', true );

			$atts = shortcode_atts( array(
						'orderby' => 'date',
						'order'	=> 'DESC',
						'cat'	=> 'all'
					), $atts, 'foodmenu' );

			@$rawCat = ($atts['cat'] == 'all' ? null : $atts['cat']);
			$settings = get_option($TLPfoodmenu->options['settings']);
			$charLength = (isset($settings['general']['character_limit']) ? ($settings['general']['character_limit'] ? intval($settings['general']['character_limit']) : 150 ) : 150);
			$col = (@$settings['general']['em_display_col'] ? @$settings['general']['em_display_col'] : 2);
			$grid=12/$col;
			
			$bss="tlp-col-md-{$grid} tlp-col-lg-{$grid} tlp-col-sm-12 paddingl0";

			if($col==2){
		          $image_area="tlp-col-md-5 tlp-col-lg-5 tlp-col-sm-6 paddingl0 ";
		          $content_area="tlp-col-md-7 tlp-col-lg-7 tlp-col-sm-6 padding0";
		      }else{
		          $image_area="tlp-col-md-3 tlp-col-lg-3 tlp-col-sm-6 paddingl0 ";
		          $content_area="tlp-col-md-9 tlp-col-lg-9 tlp-col-sm-6 padding0";
		      }

			$cat = array();
			if(isset($rawCat)){
				$rca = explode(",", $rawCat);
				if(!empty($rca)){
					foreach ($rca as $c) {
						$cat[] = $c;
					}
				}
			}
			$html      = null;
			$html .= '<div class="container-fluid">';
			$html .= '<div class="row tlp-food-menu">';
			if(!empty($cat) && is_array($cat)) {
				foreach ($cat as $c) {
					$args = array(
						'post_type'      => $TLPfoodmenu->post_type,
						'post_status'    => 'publish',
						'posts_per_page' => -1,
						'orderby'        => $atts['orderby'],
						'order'          => $atts['order'],
						'tax_query'      => array(
										array(
											'taxonomy' => $TLPfoodmenu->taxonomies['category'],
											'field'    => 'term_id',
											'terms'    => array($c),
											'operator' => 'IN',
										),
									)
					);

					$foodQuery = new WP_Query( $args );
					$term = get_term_by('id', $c, $TLPfoodmenu->taxonomies['category']);
					if ( $foodQuery->have_posts() ) {
						
						$html .= "<h2 class='category-title'>{$term->name}</h2>";
						while ( $foodQuery->have_posts() ) : $foodQuery->the_post();
							$html .= "<div class='{$bss}'>";
							$html .= "<div class='tlp-equal-height food-item'>";
								$html .= '<div class="image-area '.$image_area.'">';
									$html .= '<a href="' . get_permalink() . '" title="' . get_the_title() . '">';
									if ( has_post_thumbnail() ) {
										$html .= get_the_post_thumbnail( get_the_ID(), 'medium' );
									} else {
										$html .= "<img src='" . $TLPfoodmenu->assetsUrl . 'images/demo-55x55.png' . "' alt='" . get_the_title() . "' />";
									}
									$html .= '</a>';
								$html .= '</div>';
								$html .= '<div class="'.$content_area.'">';
									$html .= "<div class='title'>";
										$html .= '<h3><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h3>';
										$gTotal = $TLPfoodmenu->getPriceWithLabel();
										$html .= '<span class="price">' . $gTotal . '</span>';
									$html .= "</div>";
									$html .= '<p>' . $TLPfoodmenu->the_excerpt_max_charlength($charLength) . '</p>';
								$html .= '</div>';
							$html .= '</div>';
							$html .= "</div>";
						endwhile;
						
					}
				}
			}else{
				$args = array(
					'post_type'      => $TLPfoodmenu->post_type,
					'post_status'    => 'publish',
					'posts_per_page' => -1,
					'orderby'        => $atts['orderby'],
					'order'          => $atts['order']
				);
				$foodQuery = new WP_Query( $args );
				if ( $foodQuery->have_posts() ) {
					
					while ( $foodQuery->have_posts() ) : $foodQuery->the_post();
						$html .= "<div class='{$bss}'>";
						$html .= "<div class='tlp-equal-height food-item'>";
						$html .= '<div class="image-area '.$image_area.'">';
							$html .= '<a href="' . get_permalink() . '" title="' . get_the_title() . '">';
							if ( has_post_thumbnail() ) {
								$html .= get_the_post_thumbnail( get_the_ID(), 'medium' );
							} else {
								$html .= "<img src='" . $TLPfoodmenu->assetsUrl . 'images/demo-55x55.png' . "' alt='" . get_the_title() . "' />";
							}
							$html .= '</a>';
						$html .= '</div>';
						$html .= '<div class="'.$content_area.'">';
						$html .= "<div class='title'>";
							$html .= '<h3><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h3>';
							$gTotal = $TLPfoodmenu->getPriceWithLabel();
							$html .= '<div class="price">' . $gTotal . '</div>';
						$html .= '</div>';
							$html .= '<p>' . $TLPfoodmenu->the_excerpt_max_charlength($charLength) . '</p>';
						$html .= '</div>';
					$html .= '</div>';
					$html .= "</div>";
					endwhile;
					
				} else {
					$html .= "<p>" . __( 'No food found.', TLP_FOOD_MENU_SLUG ) . "</p>";
				}
			}
			$html .= '</div>';
			$html .= '</div>';
			return $html;
		}


		function foodmenu_single($atts , $content = ""){
			/**
			 * Shortcode attribute desctiption
			 * @var [type]
			 */

			global $TLPfoodmenu;
			wp_enqueue_style( 'tlp-fm-shortcode-css', $TLPfoodmenu->assetsUrl . 'css/fmshortcode.css' );

			$html = null;

			$atts = shortcode_atts( array(
						'id' => null,
					), $atts, 'foodmenu-single' );

			return $html;
		}

	}


endif;
