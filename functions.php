<?php // Exit if accessed directly
if (!defined('ABSPATH')) exit;

function register_wsf_foundation_initiatives() {

    // Ensure Elementor is loaded before creating the widget
    if (did_action('elementor/loaded')) {

        // Define custom widget class
        class WSF_Foundation_Initiatives extends \Elementor\Widget_Base {

            public function get_name() {
                return 'wsf_foundation_initiatives';
            }

            public function get_title() {
                return __('WSF Foundation Initiatives', 'text-domain');
            }

            public function get_icon() {
                return 'eicon-info-box';
            }

            public function get_categories() {
                return ['layout'];
            }

            protected function _register_controls() {
                $this->start_controls_section(
                    'content_section',
                    [
                        'label' => __('Content', 'text-domain'),
                        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    ]
                );

                $repeater = new \Elementor\Repeater();

                $repeater->add_control(
                    'item_title',
                    [
                        'label' => __('Title', 'text-domain'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => __('List Item Title', 'text-domain'),
                        'label_block' => true,
                    ]
                );

                $repeater->add_control(
                    'item_description',
                    [
                        'label' => __('Description', 'text-domain'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => __('List item description.', 'text-domain'),
                        'show_label' => true,
                    ]
                );

                $repeater->add_control(
                    'item_image',
                    [
                        'label' => __('Image', 'text-domain'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ]
                );

                $this->add_control(
                    'list',
                    [
                        'label' => __('Repeater List', 'text-domain'),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'fields' => $repeater->get_controls(),
                        'default' => [
                            [
                                'item_title' => __('Item #1', 'text-domain'),
                                'item_description' => __('Description for item #1.', 'text-domain'),
                                'item_image' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
                            ],
                            [
                                'item_title' => __('Item #2', 'text-domain'),
                                'item_description' => __('Description for item #2.', 'text-domain'),
                                'item_image' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
                            ],
                        ],
                        'title_field' => '{{{ item_title }}}',
                    ]
                );

                $this->end_controls_section();
            }

            protected function render() {
                $settings = $this->get_settings_for_display();

                if ($settings['list']) {
                    echo '<section class="wsf_foundation black">';
					echo '<div class="text-wrap">';
                    foreach ($settings['list'] as $item) {
                        echo '<div class="panel-text">';
						if (!empty($item['item_image']['url'])) {
							echo '<div class="foundation_img"><img src="' . esc_url($item['item_image']['url']) . '" alt="' . esc_attr($item['item_title']) . '"></div>';
                        }
                        echo '<h3>' . $item['item_title'] . '</h3>';
                        echo '<div class="cta">' . esc_html($item['item_description']) . '</div>';
                        echo '</div>';
                    }
					echo '</div>';
					echo '<div class="p-wrap">';
					foreach ($settings['list'] as $item) {
                        if (!empty($item['item_image']['url'])) {
							echo '<div class="panel"><img src="' . esc_url($item['item_image']['url']) . '" alt="' . esc_attr($item['item_title']) . '"></div>';
                        }
                    }
					echo '</div>';
                    echo '</section>';
                }
            }
            protected function _content_template() {
                ?>
                <# if ( settings.list.length ) { #>
                    <section class="wsf_foundation black">
						<div class="text-wrap">
                        <# _.each( settings.list, function( item ) { #>
                            <div class="panel-text">
								<# if ( item.item_image.url ) { #>
									<div class="foundation_img"><img src="{{ item.item_image.url }}" alt="{{ item.item_title }}"></div>
								<# } #>
                                <h3>{{{ item.item_title }}}</h3>
                                <div class="cta">{{{ item.item_description }}}</div>
                            </div>
                        <# }); #>
						</div>
						<div class="p-wrap">
						<# _.each( settings.list, function( item ) { #>
							<# if ( item.item_image.url ) { #>
                            <div class="panel"><img src="{{ item.item_image.url }}" alt="{{ item.item_title }}"></div>
							<# } #>
                        <# }); #>
						</div>
                    </section>
                <# } #>
                <?php
            }
        }

        // Register custom widget
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \WSF_Foundation_Initiatives());
    }
}
add_action('elementor/widgets/widgets_registered', 'register_wsf_foundation_initiatives');

?>

