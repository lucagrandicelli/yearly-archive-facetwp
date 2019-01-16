<?php
/**
 * The Yearly Archive FacetWP core class.
 *
 * @author            Luca Grandicelli - https://www.lucagrandicelli.it
 * @copyright         Copyright (C) 2018, Luca Grandicelli - https://www.lucagrandicelli.it
 * @license           http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License, version 3 or higher
 * @link              https://github.com/lucagrandicelli/yearly-archive-facetwp
 * @package           Yearly_Archive_FacetWP
 * @since             1.0.0
 * @subpackage        Yearly_Archive_FacetWP/includes
 */
class Yearly_Archive_FacetWP_Core {

	function __construct() {

		// Setting up facet label.
		$this->label = __( 'Yearly Archive', 'yearly-archive-facetwp' );
	}

	/**
	 * Loading available choices.
	 *
	 * @param [array] $params
	 * @return array
	 */
	function load_values( $params ) {

		// Importing global WP database object.
		global $wpdb;

		// Importing facet default parameters.
		$facet = $params['facet'];

		// Building up the from clause
		$from_clause = $wpdb->prefix . 'facetwp_index f';

		// Building up the Where clause
		$where_clause = $params['where_clause'];

		// Building up the Orderby clause
		$orderby = 'f.facet_display_value DESC';
		if ( ! empty( $facet['orderby'] ) && 'asc' === $facet['orderby'] ) {
			$orderby = 'f.facet_display_value ASC';
		}

		// Count setting
		$limit = array_key_exists( 'count', $facet ) && ctype_digit( $facet['count'] ) ? $facet['count'] : 10;

		// Applying filters to the SQL statement.
		$from_clause  = apply_filters( 'facetwp_facet_from', $from_clause, $facet );
		$orderby      = apply_filters( 'facetwp_facet_orderby', $orderby, $facet );
		$where_clause = apply_filters( 'facetwp_facet_where', $where_clause, $facet );

		// Building up SQL statement.
		$sql = "
		SELECT DATE_FORMAT(f.facet_value, '%Y') as facet_value, f.facet_display_value, COUNT(*) AS counter
		FROM $from_clause
		WHERE f.facet_name = '{$facet['name']}' $where_clause
		GROUP BY DATE_FORMAT(f.facet_value, '%Y')
		ORDER BY $orderby
		LIMIT $limit";

		// Return results.
		return $wpdb->get_results( $sql, ARRAY_A );
	}

	/**
	 * Generating facet HTML.
	 *
	 * @param [array] $params
	 * @return string
	 */
	function render( $params ) {

		// Fetching facet values.
		$output          = '';
		$facet           = $params['facet'];
		$values          = (array) $params['values'];
		$selected_values = (array) $params['selected_values'];

		// Setting up label for the "any" choice.
		$label_any = ! array_key_exists( 'label_any', $facet ) && empty( $facet['label_any'] )
			? __( 'Any', 'yearly-archive-facetwp' )
			: sprintf( __( '%s', 'yearly-archive-facetwp' ), $facet['label_any'] );

		// Building select HTML element for the facet backend.
		$output .= '<select class="facetwp-yearly">';
		$output .= sprintf( '<option value="">%s</option>', esc_html( $label_any ) );

		// Looping through values.
		foreach ( $values as $result ) {

			// Setting up selected value.
			$selected = in_array( $result['facet_value'], $selected_values ) ? ' selected' : '';

			// Setting up date display for each value.
			$display_value = date_i18n( 'Y', strtotime( $result['facet_display_value'] ) );

			// Displaying counter.
			$show_counts = apply_filters( 'facetwp_facet_dropdown_show_counts', true );
			if ( $show_counts ) {
				$display_value .= sprintf( ' (%s)', $result['counter'] );
			}

			// Building select option html.
			$output .= sprintf( '<option value="%s" %s>%s</option>', esc_attr( $result['facet_value'] ), $selected, esc_html( $display_value ) );
		}

		$output .= '</select>';

		// Returning html output.
		return $output;
	}

	/**
	 * Filtering query upon selected values.
	 * Returns array of post IDs matching the selected values
	 * using the wp_facetwp_index table
	 *
	 * @param [array] $params
	 * @return array
	 */
	function filter_posts( $params ) {

		// Importing global WP database object.
		global $wpdb;

		// Fetching facet values.
		$output          = array();
		$facet           = $params['facet'];
		$selected_values = $params['selected_values'];

		// Setting the internal pointer to the first element of the array.
		reset( $selected_values );

		// Fetching user's choice ( selected year ).
		$selected_year = $selected_values[0];

		// Building up SQL statement in order to filter posts by the selected year.
		$sql = $wpdb->prepare( "SELECT DISTINCT post_id
			FROM {$wpdb->prefix}facetwp_index
			WHERE facet_name = %s
			AND YEAR(facet_value) = %d
			ORDER BY facet_value DESC",
			$facet['name'],
			absint( $selected_year )
		);

		// Getting results.
		$output = $wpdb->get_col( $sql );

		// Output results.
		return $output;
	}

	/**
	 * This function prints out the admin settings HTML
	 * for the Yearly Archive facet. It appears as this facet type is selected
	 * in the Facet creation page.
	 * @return null
	 */
	function settings_html() { ?>
		<tr class="facetwp-conditional type-yearly">
			<td>
				<?php _e( 'Default label', 'yearly-archive-facetwp' ); ?>:
				<div class="facetwp-tooltip">
					<span class="icon-question">?</span>
					<div class="facetwp-tooltip-content">
						Customize the first option label (default: "Any")
					</div>
				</div>
			</td>
			<td>
				<input type="text" class="facet-label-any" value="<?php _e( 'Any', 'yearly-archive-facetwp' ); ?>"/>
			</td>
		</tr>
		<tr class="facetwp-conditional type-yearly">
			<td>
				<?php _e( 'Archive order', 'yearly-archive-facetwp' ); ?>:
				<div class="facetwp-tooltip">
					<span class="icon-question">?</span>
					<div class="facetwp-tooltip-content">
						Customize the archives order (default: "Newest to Oldest")
					</div>
				</div>
			</td>
			<td>
				<select class="facet-orderby">
					<option value="desc" selected><?php _e( 'Newest to Oldest', 'yearly-archive-facetwp' ); ?></option>
					<option value="asc"><?php _e( 'Oldest to newest', 'yearly-archive-facetwp' ); ?></option>
				</select>
			</td>
		</tr>
		<tr class="facetwp-conditional type-yearly">
			<td>
				<?php _e( 'Count', 'yearly-archive-facetwp' ); ?>:
				<div class="facetwp-tooltip">
					<span class="icon-question">?</span>
					<div class="facetwp-tooltip-content"><?php _e( 'The maximum number of facet choices to show', 'yearly-archive-facetwp' ); ?></div>
				</div>
			</td>
			<td><input type="text" class="facet-count" value="10"/></td>
		</tr>
	<?php }

	/**
	 * This function prints out the admin JS scripts to
	 * load and save facet settings.
	 * @return null
	 */
	function admin_scripts() { ?>
		<script>
		(function ($) {

			FWP.hooks.addAction( 'facetwp/load/yearly', function ( $this, obj ) {
				$this.find( '.facet-source' ).val( obj['source'] );
				$this.find( '.type-yearly .facet-label-any' ).val( obj['label_any'] );
				$this.find( '.type-yearly .facet-orderby' ).val( obj['orderby'] );
				$this.find( '.type-yearly .facet-count' ).val( obj['count'] );
			});

			FWP.hooks.addFilter( 'facetwp/save/yearly', function ( $this, obj ) {
				obj['source'] = $this.find('.facet-source').val();
				obj['label_any'] = $this.find('.type-yearly .facet-label-any').val();
				obj['orderby'] = $this.find('.type-yearly .facet-orderby').val();
				obj['count'] = $this.find('.type-yearly .facet-count').val();
				return obj;
			});

		})(jQuery);
		</script>
	<?php }

	/**
	 * This function parses the facet selections + other front-facing handlers
	 * @return null
	 */
	function front_scripts() { ?>
		<script>
			(function ($) {
				FWP.hooks.addAction('facetwp/refresh/yearly', function ($this, facet_name) {
					var val = $this.find('.facetwp-yearly').val();
					FWP.facets[facet_name] = val ? [val] : [];
				});

				FWP.hooks.addAction('facetwp/ready', function () {
					$(document).on('change', '.facetwp-facet .facetwp-yearly', function () {
						var $facet = $(this).closest('.facetwp-facet');
						if ('' != $facet.find(':selected').val()) {
							FWP.static_facet = $facet.attr('data-name');
						}
						FWP.autoload();
					});
				});
			})(jQuery);
		</script>
	<?php }
}
