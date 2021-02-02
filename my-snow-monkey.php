<?php
/**
 * Plugin name: My Snow Monkey
 * Description: このプラグインに、あなたの Snow Monkey 用カスタマイズコードを書いてください。
 * Version: 0.2.1
 *
 * @package my-snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Snow Monkey 以外のテーマを利用している場合は有効化してもカスタマイズが反映されないようにする
 */
$theme = wp_get_theme( get_template() );
if ( 'snow-monkey' !== $theme->template && 'snow-monkey/resources' !== $theme->template ) {
	return;
}

/**
 * Directory url of this plugin
 *
 * @var string
 */
define( 'MY_SNOW_MONKEY_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );

/**
 * Directory path of this plugin
 *
 * @var string
 */
define( 'MY_SNOW_MONKEY_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );

//
add_action('wp_enqueue_scripts', 'msm_enqueue_style_script');
function msm_enqueue_style_script()
{
	wp_enqueue_style(
		'msm_style',
		MY_SNOW_MONKEY_URL . '/css/myplugin_css.css',
		[],
		filemtime(MY_SNOW_MONKEY_PATH . '/css/myplugin_css.css')
	);

	wp_enqueue_script(
		'msm_scripts',
		MY_SNOW_MONKEY_URL . '/js/myplugin_js.js',
		['jquery'],
		filemtime(MY_SNOW_MONKEY_PATH . '/js/myplugin_js.js'),
		true
	);
}

//ゴミ箱内での自動削除を停止する
add_action('init', 'remove_schedule_delete');
function remove_schedule_delete()
{
	remove_action('wp_scheduled_delete', 'wp_scheduled_delete');
}