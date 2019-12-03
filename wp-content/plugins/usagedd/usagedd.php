<?php
/*
Plugin Name: UsageDD
Plugin URI: https://forum.dion-designs.com/f35/usagedd-support/
Version: 1.4.6
Author: Dion Designs
Description: Displays usage information to administrators
*/
if (!defined('WPINC')) {
	die('ERROR 000');
}

/*
	You can change the CSS for the usage display.
	DO NOT USE SINGLE-QUOTE ' CHARACTERS IN YOUR CSS!
	You have been warned.
*/

// CSS Starts after the next line
define('USAGEDD_CSS', '

.usage-dd {
	display: block;
	line-height: 24px;
	background-color: #c4c4c4;
	color: #000;
	font-family: Helvetica,Arial,sans-serif;
	font-size: 18px;
	text-align: center;
}
.usagedd-bs {
	margin: 0 45px;
}
.usagedd-ss {
	margin: 0 4px;
	border-left: 5px solid #999;
}
#usage_dd {
	position: fixed;
	left: 50%;
	bottom: 0;
	z-index: 9999998;
	margin-left: -160px;
	width: 320px;
	height: 24px;
	white-space: nowrap;
	overflow: hidden;
	background-color: rgba(160,160,160,0.5);
}

'); // CSS ends at the previous line. DO NOT CHANGE THIS LINE!

/*
	If you change the following line from false to true, you will see a
	usage line where a call to admin-ajax.php was made. Add up the
	execution times and queries on all the usage lines, and you will
	see why using admin-ajax.php should be avoided at all costs!
*/
define('USAGEDD_AJAX_USAGE', false);

class UsageDD {
	private $display = true;
	private $starttime, $servertime, $css, $ajax;

	function __construct($css, $ajax) {
		$this->css = '<style type="text/css" scoped>' . str_replace(array("\r","\n","\t"), '', $css);
		$this->ajax = $ajax;

		// give plugins/themes lots of time to set NO_USAGEDD_DISPLAY constant
		add_action('init', array($this, 'hook_setup'), 9999);

		// hooks for things where usage display should be suppressed
		add_filter('wp_xmlrpc_server_class', array($this, 'no_usage_display'));
		add_filter('rest_jsonp_enabled', array($this, 'no_usage_display'));
	}

	function hook_setup() {
		// allow a theme/plugin to disable UsageDD display
		if (!defined('NO_USAGEDD_DISPLAY')) {
			if (defined('WP_ADMIN')) {
				add_action('admin_init', array($this, 'time_to_first_byte'), 9999);
				add_action('admin_footer', function(){register_shutdown_function(array($this, 'display_usage'));}, 9999);
			}
			else {
				add_action('wp_loaded', array($this, 'time_to_first_byte'), 9999);
				add_action('wp_footer', function(){register_shutdown_function(array($this, 'display_usage'));}, 9999);
			}
		}
	}

	// function works for filter or action hooks
	function no_usage_display($val) {
		$this->display = false;
		return $val;
	}

	function time_to_first_byte() {
		// theme display/customizer does some, um, unusual things...
		if (is_admin()) {
			$this->css .= '.wrap .theme-overlay .theme-wrap,.wrap .theme-overlay .theme-backdrop,.wrap .wp-full-overlay-sidebar-content,#customize-preview iframe{bottom:24px}';
		}

		// PHP 5.4+ provides this value
		if (!empty($_SERVER['REQUEST_TIME_FLOAT'])) {
			$this->starttime = $_SERVER['REQUEST_TIME_FLOAT'];
			$this->servertime = strval(round(microtime(true) - $this->starttime, 2)) . '<span class="usagedd-ss"></span>';
		}
	}

	function display_usage() {
		if ($this->display && !defined('WP_INSTALLING') && (!defined('DOING_AJAX') || (defined('DOING_AJAX') && $this->ajax)) && current_user_can('update_core')) {
			global $wpdb;

			$precision = 0;
			$memory_usage = memory_get_peak_usage() / 1048576;
			if ($memory_usage < 10) {
				$precision = 2;
			}
			else if ($memory_usage < 100) {
				$precision = 1;
			}

			$memory_usage = round($memory_usage, $precision);
			$time_usage = (empty($this->starttime)) ? '' : $this->servertime . round(microtime(true) - $this->starttime, 2);
			echo ((defined('DOING_AJAX')) ? '' : $this->css . '</style><div id="usage_dd_spacer"></div>') . '<div class="usage-dd"' . ((defined('DOING_AJAX') && $this->ajax) ? '>' : ' id="usage_dd">') . "{$wpdb->num_queries}Q<span class=\"usagedd-bs\">{$time_usage}s</span>{$memory_usage}M</div>";
		}
	}
}

add_action('plugins_loaded', function(){if(!defined('TOOLKITDD')){new UsageDD(USAGEDD_CSS, USAGEDD_AJAX_USAGE);}}, 1);
register_activation_hook(__FILE__, function(){if(defined('TOOLKITDD')){die('Please enable UsageDD PRO in ToolkitDD.');}});
