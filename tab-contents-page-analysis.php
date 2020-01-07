<?php
/**
 * Rank Math - Page Analysis tab contents
 */
use RankMath\Helper;
use RankMath\Admin\Admin_Helper;

defined( 'ABSPATH' ) || die;

$cmb->remove_field( 'rank_math_focus_keyword' );
$cmb->add_field([
	'id'          => 'rank_math_focus_keyword',
	'type'        => 'text',
	'name'        => esc_html__( 'Focus Keyword', 'rank-math' ),
	'desc'        => sprintf( wp_kses_post( __( 'Insert keywords you want to rank for. Try to <a href="%s" target="_blank">attain 100/100 points</a> for better chances of ranking.', 'rank-math' ) ), \RankMath\KB::get( 'score-100' ) ),
	'classes'     => 'nob',
	'after_field' => Helper::is_site_connected() ? '' :
		'<div class="notice notice-warning inline"><p>' . sprintf(
			__( 'Get keyword suggestions from Google & optimize upto 5 Focus Keywords by <a href="%s" target="_blank">linking your Rank Math account</a>.', 'rank-math' ),
			Helper::get_connect_url()
		) . '</p></div>',
	'attributes'  => array(
		'placeholder' => esc_html__( 'Example: Rank Math SEO', 'rank-math' ),
	),
]);

$cmb->remove_field( 'rank_math_serp_checklist' );
$cmb->add_field([
    'id'   => 'rank_math_serp_checklist',
    'type' => 'raw',
    'file' => rank_math()->includes_dir() . 'metaboxes/serp-checklist.php',
]);
