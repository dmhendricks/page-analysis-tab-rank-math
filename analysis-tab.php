<?php
/**
 * @wordpress-plugin
 * Plugin Name:       Page Analysis Tab for Rank Math
 * Plugin URI:        https://github.com/dmhendricks/page-analysis-tab-rank-math/
 * Description:       An add-on for the Rank Math WordPress plugin that moves On-Page Analysis from the General tab to its own.
 * Version:           0.1.0
 * Author:            Daniel M. Hendricks
 * Author URI:        https://daniel.hn/
 * Requires at least: 4.7
 * Requires PHP:      5.6
 * Tested up to:      5.0
 * Stable tag:        1.0.0
 * License:           GPLv2 or later
 * License URI:       https://github.com/dmhendricks/page-analysis-tab-rank-math/blob/master/LICENSE
 */

/**
 * Copyright 2019	  Daniel M. Hendricks (https://daniel.hn/)
 * 
 * This program is free software; you can redistribute it and/or modify it under the terms of the
 * GNU General Public License as published by the Free Software Foundation; either version 2 of
 * the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License along with this program;
 * if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

namespace CloudVerve;

class RankMathPageAnalysisTab {

    private static $instance;
    private static $plugin_dir;
    
    public static function load( $plugin_dir ) {

        if ( !isset( self::$instance ) && !( self::$instance instanceof RankMathPageAnalysisTab ) ) {

            self::$instance = new RankMathPageAnalysisTab;
            self::$plugin_dir = trailingslashit( $plugin_dir );

            // Add Page Analysis tab
            add_action( 'rank_math/metabox/tabs', array( self::$instance, 'modify_rankmath_tabs' ) );

        }

        return self::$instance;

    }

    public static function modify_rankmath_tabs( $tabs ) {

        // Add analysis tab
        $analysis_tab['analysis'] = [
            'icon' => 'dashicons dashicons-chart-bar',
            'title' => 'Page Analysis',
            'desc' => 'Page Analysis',
            'file' => self::$plugin_dir . 'tab-contents-page-analysis.php',
            'capability' => 'onpage_analysis'
        ];

        // Insert in the second position, after the General tab
        $position = 1;
        $tabs = array_slice( $tabs, 0, $position, true ) + $analysis_tab + array_slice( $tabs, $position, null, true );

        return $tabs;

    }

}

RankMathPageAnalysisTab::load( __DIR__ );
