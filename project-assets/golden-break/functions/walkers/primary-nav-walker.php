<?php
class PrimaryNavWalker extends Walker_Nav_Menu
{
    private $is_mobile;

    public function __construct($is_mobile = false)
    {
        $this->is_mobile = $is_mobile;
    }

    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= '<ul class="sub-menu">';

        if ($depth === 0) {
            $output .= '<li class="site-nav-links"><ul>';
        }

        if ($this->is_mobile) {
            ob_start();
            get_template_part('template-parts/UI/back-button', null, [
                'function' => 'back-to-previous-menu',
                'label' => __('Back to previous menu', 'golden-break')
            ]);
            $back_button_html = ob_get_clean();

            $output .= '<li class="nav-item-controls">' . $back_button_html . '</li>';
        }
    }

    public function end_lvl(&$output, $depth = 0, $args = null)
    {
        if ($depth === 0) {
            $output .= '</ul></li>';
        }

        if (!$this->is_mobile && $depth === 0) {
            $close_svg = GetSvg::import('/assets/img/icons/close.svg', true);
            $output .= '<li class="nav-item-close"><button aria-label="' . __('Close submenu', 'golden-break') . '" data-function="close-nav-menu">' . $close_svg . '</button></li>';
        }

        $output .= '</ul>';
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $has_children = in_array('menu-item-has-children', $item->classes);

        $output .= '<li id="menu-item-' . $item->ID . '" class="' . implode(' ', $item->classes) . '">';
        $output .= '<a href="' . esc_url($item->url) . '">' . $item->title;

        if (($this->is_mobile || $depth === 0) && $has_children) {
            $chevron_svg = $this->is_mobile ? GetSvg::import('/assets/img/icons/chevron-right.svg', true) : GetSvg::import('/assets/img/icons/chevron-down.svg', true);
            $output .= ' <span class="chevron">' . $chevron_svg . '</span>';
        }

        $output .= '</a>';
    }

    public function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= '</li>';
    }
}
