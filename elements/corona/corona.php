<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Background;
use \ExclusiveAddons\Elementor\Helper;

/**
 * Corona Element
 */
class Corona extends Widget_Base {
    
    /**
	 * Retrieve Corona widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
    public function get_name() {
        return 'exad-corona';
    }

    /**
	 * Retrieve Corona widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
    public function get_title() {
        return __( 'Corona Update', 'exclusive-addons-elementor' );
    }

    /**
	 * Retrieve the list of categories the Corona widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
    public function get_categories() {
        return [ 'exclusive-addons-elementor' ];
    }

    /**
	 * Retrieve Corona widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
    public function get_icon() {
        return 'exad-element-icon eicon-mail';
    }

    /**
	 * Register Corona widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
    protected function _register_controls() {
        $exad_primary_color = get_option( 'exad_primary_color_option', '#7a56ff' );
 
        $this->start_controls_section(
            'exad_section_corona_udpate',
            [
                'label'  => __( 'Corona Update', 'exclusive-addons-elementor' ),
            ]
        );

        $this->add_control(
            'exad_section_corona_country_base',
            [
                'label'   => __( 'Country', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'USA',
                'options' => [
                    'Afghanistan'  => __( 'Afghanistan',  'exclusive-addons-elementor' ),
                    'Albania'  => __( 'Albania',  'exclusive-addons-elementor' ),
                    'Algeria'  => __( 'Algeria',  'exclusive-addons-elementor' ),
                    'Andorra'  => __( 'Andorra',  'exclusive-addons-elementor' ),
                    'Angola'  => __( 'Angola',  'exclusive-addons-elementor' ),
                    'Anguilla'  => __( 'Anguilla',  'exclusive-addons-elementor' ),
                    'Argentina'  => __( 'Argentina',  'exclusive-addons-elementor' ),
                    'Aruba'  => __( 'Aruba',  'exclusive-addons-elementor' ),
                    'Australia'  => __( 'Australia',  'exclusive-addons-elementor' ),
                    'Austria'  => __( 'Austria',  'exclusive-addons-elementor' ),
                    'Azerbaijan'  => __( 'Azerbaijan',  'exclusive-addons-elementor' ),
                    'Bahamas'  => __( 'Bahamas',  'exclusive-addons-elementor' ),
                    'Bahrain'  => __( 'Bahrain',  'exclusive-addons-elementor' ),
                    'Bangladesh'  => __( 'Bangladesh',  'exclusive-addons-elementor' ),
                    'Barbados'  => __( 'Barbados',  'exclusive-addons-elementor' ),
                    'Belarus'  => __( 'Belarus',  'exclusive-addons-elementor' ),
                    'Belgium'  => __( 'Belgium',  'exclusive-addons-elementor' ),
                    'Belize'  => __( 'Belize',  'exclusive-addons-elementor' ),
                    'Benin'  => __( 'Benin',  'exclusive-addons-elementor' ),
                    'Bermuda'  => __( 'Bermuda',  'exclusive-addons-elementor' ),
                    'Bhutan'  => __( 'Bhutan',  'exclusive-addons-elementor' ),
                    'Bolivia'  => __( 'Bolivia',  'exclusive-addons-elementor' ),
                    'Bosnia'  => __( 'Bosnia',  'exclusive-addons-elementor' ),
                    'Botswana'  => __( 'Botswana',  'exclusive-addons-elementor' ),
                    'Brazil'  => __( 'Brazil',  'exclusive-addons-elementor' ),
                    'British Virgin Islands'  => __( 'British Virgin Islands',  'exclusive-addons-elementor' ),
                    'Brunei'  => __( 'Brunei',  'exclusive-addons-elementor' ),
                    'Bulgaria'  => __( 'Bulgaria',  'exclusive-addons-elementor' ),
                    'Burkina Faso'  => __( 'Burkina Faso',  'exclusive-addons-elementor' ),
                    'Burundi'  => __( 'Burundi',  'exclusive-addons-elementor' ),
                    'Cabo Verde'  => __( 'Cabo Verde',  'exclusive-addons-elementor' ),
                    'Cambodia'  => __( 'Cambodia',  'exclusive-addons-elementor' ),
                    'Cameroon'  => __( 'Cameroon',  'exclusive-addons-elementor' ),
                    'Canada'  => __( 'Canada',  'exclusive-addons-elementor' ),
                    'Caribbean Netherlands'  => __( 'Caribbean Netherlands',  'exclusive-addons-elementor' ),
                    'Cayman Islands'  => __( 'Cayman Islands',  'exclusive-addons-elementor' ),
                    'Central African Republic'  => __( 'Central African Republic',  'exclusive-addons-elementor' ),
                    'Chad'  => __( 'Chad',  'exclusive-addons-elementor' ),
                    'Channel Islands'  => __( 'Channel Islands',  'exclusive-addons-elementor' ),
                    'Chile'  => __( 'Chile',  'exclusive-addons-elementor' ),
                    'China'  => __( 'China',  'exclusive-addons-elementor' ),
                    'Colombia'  => __( 'Colombia',  'exclusive-addons-elementor' ),
                    'Comoros'  => __( 'Comoros',  'exclusive-addons-elementor' ),
                    'Congo'  => __( 'Congo',  'exclusive-addons-elementor' ),
                    'Costa Rica'  => __( 'Costa Rica',  'exclusive-addons-elementor' ),
                    'Croatia'  => __( 'Croatia',  'exclusive-addons-elementor' ),
                    'Cuba'  => __( 'Cuba',  'exclusive-addons-elementor' ),
                    'Curaçao'  => __( 'Curaçao',  'exclusive-addons-elementor' ),
                    'Cyprus'  => __( 'Cyprus',  'exclusive-addons-elementor' ),
                    'Czechia'  => __( 'Czechia',  'exclusive-addons-elementor' ),
                    'Côte d\'Ivoire'  => __( 'Côte d\'Ivoire',  'exclusive-addons-elementor' ),
                    'DRC'  => __( 'DRC',  'exclusive-addons-elementor' ),
                    'Denmark'  => __( 'Denmark',  'exclusive-addons-elementor' ),
                    'Diamond Princess'  => __( 'Diamond Princess',  'exclusive-addons-elementor' ),
                    'Djibouti'  => __( 'Djibouti',  'exclusive-addons-elementor' ),
                    'Dominica'  => __( 'Dominica',  'exclusive-addons-elementor' ),
                    'Dominican Republic'  => __( 'Dominican Republic',  'exclusive-addons-elementor' ),
                    'Ecuador'  => __( 'Ecuador',  'exclusive-addons-elementor' ),
                    'Egypt'  => __( 'Egypt',  'exclusive-addons-elementor' ),
                    'El Salvador'  => __( 'El Salvador',  'exclusive-addons-elementor' ),
                    'Equatorial Guinea'  => __( 'Equatorial Guinea',  'exclusive-addons-elementor' ),
                    'Eritrea'  => __( 'Eritrea',  'exclusive-addons-elementor' ),
                    'Estonia'  => __( 'Estonia',  'exclusive-addons-elementor' ),
                    'Ethiopia'  => __( 'Ethiopia',  'exclusive-addons-elementor' ),
                    'Falkland Islands (Malvinas)'  => __( 'Falkland Islands (Malvinas)',  'exclusive-addons-elementor' ),
                    'Faroe Islands'  => __( 'Faroe Islands',  'exclusive-addons-elementor' ),
                    'Fiji'  => __( 'Fiji',  'exclusive-addons-elementor' ),
                    'Finland'  => __( 'Finland',  'exclusive-addons-elementor' ),
                    'France'  => __( 'France',  'exclusive-addons-elementor' ),
                    'French Guiana"'  => __( 'French Guiana"',  'exclusive-addons-elementor' ),
                    'French Polynesia'  => __( 'French Polynesia',  'exclusive-addons-elementor' ),
                    'Gabon'  => __( 'Gabon',  'exclusive-addons-elementor' ),
                    'Gambia'  => __( 'Gambia',  'exclusive-addons-elementor' ),
                    'Georgia'  => __( 'Georgia',  'exclusive-addons-elementor' ),
                    'Germany'  => __( 'Germany',  'exclusive-addons-elementor' ),
                    'Ghana'  => __( 'Ghana',  'exclusive-addons-elementor' ),
                    'Gibraltar'  => __( 'Gibraltar',  'exclusive-addons-elementor' ),
                    'Greece'  => __( 'Greece',  'exclusive-addons-elementor' ),
                    'Greenland'  => __( 'Greenland',  'exclusive-addons-elementor' ),
                    'Grenada'  => __( 'Grenada',  'exclusive-addons-elementor' ),
                    'Guadeloupe'  => __( 'Guadeloupe',  'exclusive-addons-elementor' ),
                    'Guatemala'  => __( 'Guatemala',  'exclusive-addons-elementor' ),
                    'Guinea'  => __( 'Guinea',  'exclusive-addons-elementor' ),
                    'Guinea-Bissau'  => __( 'Guinea-Bissau',  'exclusive-addons-elementor' ),
                    'Guyana'  => __( 'Guyana',  'exclusive-addons-elementor' ),
                    'Haiti'  => __( 'Haiti',  'exclusive-addons-elementor' ),
                    'Holy See'  => __( 'Holy See (Vatican City State)',  'exclusive-addons-elementor' ),
                    'Honduras'  => __( 'Honduras',  'exclusive-addons-elementor' ),
                    'Hong Kong'  => __( 'Hong Kong',  'exclusive-addons-elementor' ),
                    'Hungary'  => __( 'Hungary',  'exclusive-addons-elementor' ),
                    'Iceland'  => __( 'Iceland',  'exclusive-addons-elementor' ),
                    'India'  => __( 'India',  'exclusive-addons-elementor' ),
                    'Indonesia'  => __( 'Indonesia',  'exclusive-addons-elementor' ),
                    'Iran'  => __( 'Iran',  'exclusive-addons-elementor' ),
                    'Iraq'  => __( 'Iraq',  'exclusive-addons-elementor' ),
                    'Ireland'  => __( 'Ireland',  'exclusive-addons-elementor' ),
                    'Isle of Man'  => __( 'Isle of Man',  'exclusive-addons-elementor' ),
                    'Israel'  => __( 'Israel',  'exclusive-addons-elementor' ),
                    'Italy'  => __( 'Italy',  'exclusive-addons-elementor' ),
                    'Jamaica'  => __( 'Jamaica',  'exclusive-addons-elementor' ),
                    'Japan'  => __( 'Japan',  'exclusive-addons-elementor' ),
                    'Jordan'  => __( 'Jordan',  'exclusive-addons-elementor' ),
                    'Kazakhstan'  => __( 'Kazakhstan',  'exclusive-addons-elementor' ),
                    'Kenya'  => __( 'Kenya',  'exclusive-addons-elementor' ),
                    'Kuwait'  => __( 'Kuwait',  'exclusive-addons-elementor' ),
                    'Kyrgyzstan'  => __( 'Kyrgyzstan',  'exclusive-addons-elementor' ),
                    'Lao People\'s Democratic Republic"'  => __( 'Lao People\'s Democratic Republic"',  'exclusive-addons-elementor' ),
                    'Latvia'  => __( 'Latvia',  'exclusive-addons-elementor' ),
                    'Lebanon'  => __( 'Lebanon',  'exclusive-addons-elementor' ),
                    'Lesotho'  => __( 'Lesotho',  'exclusive-addons-elementor' ),
                    'Liberia'  => __( 'Liberia',  'exclusive-addons-elementor' ),
                    'Libyan Arab Jamahiriya'  => __( 'Libyan Arab Jamahiriya',  'exclusive-addons-elementor' ),
                    'Liechtenstein'  => __( 'Liechtenstein',  'exclusive-addons-elementor' ),
                    'Lithuania'  => __( 'Lithuania',  'exclusive-addons-elementor' ),
                    'Luxembourg'  => __( 'Luxembourg',  'exclusive-addons-elementor' ),
                    'MS Zaandam'  => __( 'MS Zaandam',  'exclusive-addons-elementor' ),
                    'Macao'  => __( 'Macao',  'exclusive-addons-elementor' ),
                    'Macedonia'  => __( 'Macedonia',  'exclusive-addons-elementor' ),
                    'Madagascar'  => __( 'Madagascar',  'exclusive-addons-elementor' ),
                    'Malawi'  => __( 'Malawi',  'exclusive-addons-elementor' ),
                    'Malaysia'  => __( 'Malaysia',  'exclusive-addons-elementor' ),
                    'Maldives'  => __( 'Maldives',  'exclusive-addons-elementor' ),
                    'Mali'  => __( 'Mali',  'exclusive-addons-elementor' ),
                    'Malta'  => __( 'Malta',  'exclusive-addons-elementor' ),
                    'Martinique'  => __( 'Martinique',  'exclusive-addons-elementor' ),
                    'Mauritania'  => __( 'Mauritania',  'exclusive-addons-elementor' ),
                    'Mauritius'  => __( 'Mauritius',  'exclusive-addons-elementor' ),
                    'Mayotte'  => __( 'Mayotte',  'exclusive-addons-elementor' ),
                    'Mexico'  => __( 'Mexico',  'exclusive-addons-elementor' ),
                    'Moldova'  => __( 'Moldova',  'exclusive-addons-elementor' ),
                    'Monaco'  => __( 'Monaco',  'exclusive-addons-elementor' ),
                    'Mongolia'  => __( 'Mongolia',  'exclusive-addons-elementor' ),
                    'Montenegro'  => __( 'Montenegro',  'exclusive-addons-elementor' ),
                    'Montserrat'  => __( 'Montserrat',  'exclusive-addons-elementor' ),
                    'Morocco'  => __( 'Morocco',  'exclusive-addons-elementor' ),
                    'Mozambique'  => __( 'Mozambique',  'exclusive-addons-elementor' ),
                    'Myanmar'  => __( 'Myanmar',  'exclusive-addons-elementor' ),
                    'Namibia'  => __( 'Namibia',  'exclusive-addons-elementor' ),
                    'Nepal'  => __( 'Nepal',  'exclusive-addons-elementor' ),
                    'Netherlands'  => __( 'Netherlands',  'exclusive-addons-elementor' ),
                    'New Caledonia'  => __( 'New Caledonia',  'exclusive-addons-elementor' ),
                    'New Zealand'  => __( 'New Zealand',  'exclusive-addons-elementor' ),
                    'Nicaragua'  => __( 'Nicaragua',  'exclusive-addons-elementor' ),
                    'Niger'  => __( 'Niger',  'exclusive-addons-elementor' ),
                    'Nigeria'  => __( 'Nigeria',  'exclusive-addons-elementor' ),
                    'Norway'  => __( 'Norway',  'exclusive-addons-elementor' ),
                    'Oman'  => __( 'Oman',  'exclusive-addons-elementor' ),
                    'Pakistan'  => __( 'Pakistan',  'exclusive-addons-elementor' ),
                    'Palestine'  => __( 'Palestine',  'exclusive-addons-elementor' ),
                    'Panama'  => __( 'Panama',  'exclusive-addons-elementor' ),
                    'Papua New Guinea'  => __( 'Papua New Guinea',  'exclusive-addons-elementor' ),
                    'Paraguay'  => __( 'Paraguay',  'exclusive-addons-elementor' ),
                    'Peru'  => __( 'Peru',  'exclusive-addons-elementor' ),
                    'Philippines'  => __( 'Philippines',  'exclusive-addons-elementor' ),
                    'Poland'  => __( 'Poland',  'exclusive-addons-elementor' ),
                    'Portugal'  => __( 'Portugal',  'exclusive-addons-elementor' ),
                    'Qatar'  => __( 'Qatar',  'exclusive-addons-elementor' ),
                    'Romania'  => __( 'Romania',  'exclusive-addons-elementor' ),
                    'Russia'  => __( 'Russia',  'exclusive-addons-elementor' ),
                    'Rwanda'  => __( 'Rwanda',  'exclusive-addons-elementor' ),
                    'Réunion'  => __( 'Réunion',  'exclusive-addons-elementor' ),
                    'S. Korea'  => __( 'S. Korea',  'exclusive-addons-elementor' ),
                    'Saint Kitts and Nevis'  => __( 'Saint Kitts and Nevis',  'exclusive-addons-elementor' ),
                    'Saint Lucia'  => __( 'Saint Lucia',  'exclusive-addons-elementor' ),
                    'Saint Martin'  => __( 'Saint Martin',  'exclusive-addons-elementor' ),
                    'Saint Pierre Miquelon'  => __( 'Saint Pierre Miquelon',  'exclusive-addons-elementor' ),
                    'Saint Vincent and the Grenadines'  => __( 'Saint Vincent and the Grenadines',  'exclusive-addons-elementor' ),
                    'San Marino'  => __( 'San Marino',  'exclusive-addons-elementor' ),
                    'Sao Tome and Principe'  => __( 'Sao Tome and Principe',  'exclusive-addons-elementor' ),
                    'Saudi Arabia'  => __( 'Saudi Arabia',  'exclusive-addons-elementor' ),
                    'Senegal'  => __( 'Senegal',  'exclusive-addons-elementor' ),
                    'Serbia'  => __( 'Serbia',  'exclusive-addons-elementor' ),
                    'Seychelles'  => __( 'Seychelles',  'exclusive-addons-elementor' ),
                    'Sierra Leone'  => __( 'Sierra Leone',  'exclusive-addons-elementor' ),
                    'Singapore'  => __( 'Singapore',  'exclusive-addons-elementor' ),
                    'Sint Maarten'  => __( 'Sint Maarten',  'exclusive-addons-elementor' ),
                    'Slovakia'  => __( 'Slovakia',  'exclusive-addons-elementor' ),
                    'Slovenia'  => __( 'Slovenia',  'exclusive-addons-elementor' ),
                    'Somalia'  => __( 'Somalia',  'exclusive-addons-elementor' ),
                    'South Africa'  => __( 'South Africa',  'exclusive-addons-elementor' ),
                    'South Sudan'  => __( 'South Sudan',  'exclusive-addons-elementor' ),
                    'Spain'  => __( 'Spain',  'exclusive-addons-elementor' ),
                    'Sri Lanka'  => __( 'Sri Lanka',  'exclusive-addons-elementor' ),
                    'St. Barth'  => __( 'St. Barth',  'exclusive-addons-elementor' ),
                    'Sudan'  => __( 'Sudan',  'exclusive-addons-elementor' ),
                    'Suriname'  => __( 'Suriname',  'exclusive-addons-elementor' ),
                    'Swaziland'  => __( 'Swaziland',  'exclusive-addons-elementor' ),
                    'Sweden'  => __( 'Sweden',  'exclusive-addons-elementor' ),
                    'Switzerland'  => __( 'Switzerland',  'exclusive-addons-elementor' ),
                    'Syrian Arab Republic'  => __( 'Syrian Arab Republic',  'exclusive-addons-elementor' ),
                    'Taiwan'  => __( 'Taiwan',  'exclusive-addons-elementor' ),
                    'Tajikistan'  => __( 'Tajikistan',  'exclusive-addons-elementor' ),
                    'Tanzania'  => __( 'Tanzania',  'exclusive-addons-elementor' ),
                    'Thailand'  => __( 'Thailand',  'exclusive-addons-elementor' ),
                    'Timor-Leste'  => __( 'Timor-Leste',  'exclusive-addons-elementor' ),
                    'Togo'  => __( 'Togo',  'exclusive-addons-elementor' ),
                    'Trinidad and Tobago'  => __( 'Trinidad and Tobago',  'exclusive-addons-elementor' ),
                    'Tunisia'  => __( 'Tunisia',  'exclusive-addons-elementor' ),
                    'Turkey'  => __( 'Turkey',  'exclusive-addons-elementor' ),
                    'Turks and Caicos Islands'  => __( 'Turks and Caicos Islands',  'exclusive-addons-elementor' ),
                    'UAE'  => __( 'UAE',  'exclusive-addons-elementor' ),
                    'UK'  => __( 'UK',  'exclusive-addons-elementor' ),
                    'USA'  => __( 'USA',  'exclusive-addons-elementor' ),
                    'Uganda'  => __( 'Uganda',  'exclusive-addons-elementor' ),
                    'Ukraine'  => __( 'Ukraine',  'exclusive-addons-elementor' ),
                    'Uruguay'  => __( 'Uruguay',  'exclusive-addons-elementor' ),
                    'Uzbekistan'  => __( 'Uzbekistan',  'exclusive-addons-elementor' ),
                    'Venezuela'  => __( 'Venezuela',  'exclusive-addons-elementor' ),
                    'Vietnam'  => __( 'Vietnam',  'exclusive-addons-elementor' ),
                    'Western Sahara'  => __( 'Western Sahara',  'exclusive-addons-elementor' ),
                    'Yemen'  => __( 'Yemen',  'exclusive-addons-elementor' ),
                    'Zambia'  => __( 'Zambia',  'exclusive-addons-elementor' ),
                    'Zimbabwe'  => __( 'Zimbabwe',  'exclusive-addons-elementor' )
                ]
            ]
        );
		
        $this->end_controls_section();

    }

    /**
	 * @access protected
	 */
    protected function render() {
        $settings = $this->get_settings();

        $country = $settings['exad_section_corona_country_base'];

        $response = wp_remote_get( sprintf( 'https://disease.sh/v2/countries/%s', $country ) );

        echo '<pre>';
            $details_object = json_decode(json_encode($response['body']), true);
            $details_params = json_decode( $details_object, true );
            $dateformat1 = intval( $details_params['updated']/1000 );
            $dateformat2 = date( 'Y/m/d h:i A', $dateformat1 );
            echo $dateformat2;
            print_r( $details_params );

        echo '</pre>';
        echo "<br>===================<br>";
        ?>
        <div class="exad-corona-params">
            <?php _e( 'Total Cases: ', 'exclusive-addons-elementor' ); ?>
            <?php echo '<span>'. esc_html( $details_params['cases'] ) . '</span>'; ?>
        </div>

        <?php
        echo '<pre>';
            print_r( $response );
        echo '</pre>';
    }
}