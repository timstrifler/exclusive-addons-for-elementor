<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Background;
use \Elementor\Utils;
use \ExclusiveAddons\Elementor\Helper;

/**
 * Corona Element
 */
class Covid_19_Stats extends Widget_Base {
    
    /**
	 * Retrieve Corona widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
    public function get_name() {
        return 'exad-covid-19';
    }

    /**
	 * Retrieve Corona widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
    public function get_title() {
        return __( 'Covid-19 Stats', 'exclusive-addons-elementor' );
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
        return 'exad exad-logo exad-covid-19';
    }

    public function get_keywords() {
        return [ 'exclusive', 'covid19', 'statistics', 'corona', 'coronavirus' ];
    }

    /**
	 * Register Corona widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
    protected function register_controls() {
        $exad_primary_color = get_option( 'exad_primary_color_option', '#7a56ff' );
 
        $this->start_controls_section(
            'exad_section_corona_udpate',
            [
                'label'  => __( 'Info Block', 'exclusive-addons-elementor' ),
            ]
        );

        $this->add_control(
        'exad_section_corona_country_base',
        [
            'label'   => __( 'Country', 'exclusive-addons-elementor' ),
            'type'    => Controls_Manager::SELECT,
            'default' => 'All',
            'options' => [
                'All'                                => __( 'All', 'exclusive-addons-elementor' ),
                'Afghanistan'                        => __( 'Afghanistan', 'exclusive-addons-elementor' ),
                'Albania'                            => __( 'Albania', 'exclusive-addons-elementor' ),
                'Algeria'                            => __( 'Algeria', 'exclusive-addons-elementor' ),
                'Andorra'                            => __( 'Andorra', 'exclusive-addons-elementor' ),
                'Angola'                             => __( 'Angola', 'exclusive-addons-elementor' ),
                'Anguilla'                           => __( 'Anguilla', 'exclusive-addons-elementor' ),
                'Argentina'                          => __( 'Argentina', 'exclusive-addons-elementor' ),
                'Aruba'                              => __( 'Aruba', 'exclusive-addons-elementor' ),
                'Australia'                          => __( 'Australia', 'exclusive-addons-elementor' ),
                'Austria'                            => __( 'Austria', 'exclusive-addons-elementor' ),
                'Azerbaijan'                         => __( 'Azerbaijan', 'exclusive-addons-elementor' ),
                'Bahamas'                            => __( 'Bahamas', 'exclusive-addons-elementor' ),
                'Bahrain'                            => __( 'Bahrain', 'exclusive-addons-elementor' ),
                'Bangladesh'                         => __( 'Bangladesh', 'exclusive-addons-elementor' ),
                'Barbados'                           => __( 'Barbados', 'exclusive-addons-elementor' ),
                'Belarus'                            => __( 'Belarus', 'exclusive-addons-elementor' ),
                'Belgium'                            => __( 'Belgium', 'exclusive-addons-elementor' ),
                'Belize'                             => __( 'Belize', 'exclusive-addons-elementor' ),
                'Benin'                              => __( 'Benin', 'exclusive-addons-elementor' ),
                'Bermuda'                            => __( 'Bermuda', 'exclusive-addons-elementor' ),
                'Bhutan'                             => __( 'Bhutan', 'exclusive-addons-elementor' ),
                'Bolivia'                            => __( 'Bolivia', 'exclusive-addons-elementor' ),
                'Bosnia'                             => __( 'Bosnia', 'exclusive-addons-elementor' ),
                'Botswana'                           => __( 'Botswana', 'exclusive-addons-elementor' ),
                'Brazil'                             => __( 'Brazil', 'exclusive-addons-elementor' ),
                'British Virgin Islands'             => __( 'British Virgin Islands', 'exclusive-addons-elementor' ),
                'Brunei'                             => __( 'Brunei', 'exclusive-addons-elementor' ),
                'Bulgaria'                           => __( 'Bulgaria', 'exclusive-addons-elementor' ),
                'Burkina Faso'                       => __( 'Burkina Faso', 'exclusive-addons-elementor' ),
                'Burundi'                            => __( 'Burundi', 'exclusive-addons-elementor' ),
                'Cabo Verde'                         => __( 'Cabo Verde', 'exclusive-addons-elementor' ),
                'Cambodia'                           => __( 'Cambodia', 'exclusive-addons-elementor' ),
                'Cameroon'                           => __( 'Cameroon', 'exclusive-addons-elementor' ),
                'Canada'                             => __( 'Canada', 'exclusive-addons-elementor' ),
                'Caribbean Netherlands'              => __( 'Caribbean Netherlands', 'exclusive-addons-elementor' ),
                'Cayman Islands'                     => __( 'Cayman Islands', 'exclusive-addons-elementor' ),
                'Central African Republic'           => __( 'Central African Republic', 'exclusive-addons-elementor' ),
                'Chad'                               => __( 'Chad', 'exclusive-addons-elementor' ),
                'Channel Islands'                    => __( 'Channel Islands', 'exclusive-addons-elementor' ),
                'Chile'                              => __( 'Chile', 'exclusive-addons-elementor' ),
                'China'                              => __( 'China', 'exclusive-addons-elementor' ),
                'Colombia'                           => __( 'Colombia', 'exclusive-addons-elementor' ),
                'Comoros'                            => __( 'Comoros', 'exclusive-addons-elementor' ),
                'Congo'                              => __( 'Congo', 'exclusive-addons-elementor' ),
                'Costa Rica'                         => __( 'Costa Rica', 'exclusive-addons-elementor' ),
                'Croatia'                            => __( 'Croatia', 'exclusive-addons-elementor' ),
                'Cuba'                               => __( 'Cuba', 'exclusive-addons-elementor' ),
                'Curaçao'                            => __( 'Curaçao', 'exclusive-addons-elementor' ),
                'Cyprus'                             => __( 'Cyprus', 'exclusive-addons-elementor' ),
                'Czechia'                            => __( 'Czechia', 'exclusive-addons-elementor' ),
                'Côte d\'Ivoire'                     => __( 'Côte d\'Ivoire', 'exclusive-addons-elementor' ),
                'DRC'                                => __( 'DRC', 'exclusive-addons-elementor' ),
                'Denmark'                            => __( 'Denmark', 'exclusive-addons-elementor' ),
                'Diamond Princess'                   => __( 'Diamond Princess', 'exclusive-addons-elementor' ),
                'Djibouti'                           => __( 'Djibouti', 'exclusive-addons-elementor' ),
                'Dominica'                           => __( 'Dominica', 'exclusive-addons-elementor' ),
                'Dominican Republic'                 => __( 'Dominican Republic', 'exclusive-addons-elementor' ),
                'Ecuador'                            => __( 'Ecuador', 'exclusive-addons-elementor' ),
                'Egypt'                              => __( 'Egypt', 'exclusive-addons-elementor' ),
                'El Salvador'                        => __( 'El Salvador', 'exclusive-addons-elementor' ),
                'Equatorial Guinea'                  => __( 'Equatorial Guinea', 'exclusive-addons-elementor' ),
                'Eritrea'                            => __( 'Eritrea', 'exclusive-addons-elementor' ),
                'Estonia'                            => __( 'Estonia', 'exclusive-addons-elementor' ),
                'Ethiopia'                           => __( 'Ethiopia', 'exclusive-addons-elementor' ),
                'Falkland Islands (Malvinas)'        => __( 'Falkland Islands (Malvinas)', 'exclusive-addons-elementor' ),
                'Faroe Islands'                      => __( 'Faroe Islands', 'exclusive-addons-elementor' ),
                'Fiji'                               => __( 'Fiji', 'exclusive-addons-elementor' ),
                'Finland'                            => __( 'Finland', 'exclusive-addons-elementor' ),
                'France'                             => __( 'France', 'exclusive-addons-elementor' ),
                'French Guiana"'                     => __( 'French Guiana"', 'exclusive-addons-elementor' ),
                'French Polynesia'                   => __( 'French Polynesia', 'exclusive-addons-elementor' ),
                'Gabon'                              => __( 'Gabon', 'exclusive-addons-elementor' ),
                'Gambia'                             => __( 'Gambia', 'exclusive-addons-elementor' ),
                'Georgia'                            => __( 'Georgia', 'exclusive-addons-elementor' ),
                'Germany'                            => __( 'Germany', 'exclusive-addons-elementor' ),
                'Ghana'                              => __( 'Ghana', 'exclusive-addons-elementor' ),
                'Gibraltar'                          => __( 'Gibraltar', 'exclusive-addons-elementor' ),
                'Greece'                             => __( 'Greece', 'exclusive-addons-elementor' ),
                'Greenland'                          => __( 'Greenland', 'exclusive-addons-elementor' ),
                'Grenada'                            => __( 'Grenada', 'exclusive-addons-elementor' ),
                'Guadeloupe'                         => __( 'Guadeloupe', 'exclusive-addons-elementor' ),
                'Guatemala'                          => __( 'Guatemala', 'exclusive-addons-elementor' ),
                'Guinea'                             => __( 'Guinea', 'exclusive-addons-elementor' ),
                'Guinea-Bissau'                      => __( 'Guinea-Bissau', 'exclusive-addons-elementor' ),
                'Guyana'                             => __( 'Guyana', 'exclusive-addons-elementor' ),
                'Haiti'                              => __( 'Haiti', 'exclusive-addons-elementor' ),
                'Holy See'                           => __( 'Holy See (Vatican City State)', 'exclusive-addons-elementor' ),
                'Honduras'                           => __( 'Honduras', 'exclusive-addons-elementor' ),
                'Hong Kong'                          => __( 'Hong Kong', 'exclusive-addons-elementor' ),
                'Hungary'                            => __( 'Hungary', 'exclusive-addons-elementor' ),
                'Iceland'                            => __( 'Iceland', 'exclusive-addons-elementor' ),
                'India'                              => __( 'India', 'exclusive-addons-elementor' ),
                'Indonesia'                          => __( 'Indonesia', 'exclusive-addons-elementor' ),
                'Iran'                               => __( 'Iran', 'exclusive-addons-elementor' ),
                'Iraq'                               => __( 'Iraq', 'exclusive-addons-elementor' ),
                'Ireland'                            => __( 'Ireland', 'exclusive-addons-elementor' ),
                'Isle of Man'                        => __( 'Isle of Man', 'exclusive-addons-elementor' ),
                'Israel'                             => __( 'Israel', 'exclusive-addons-elementor' ),
                'Italy'                              => __( 'Italy', 'exclusive-addons-elementor' ),
                'Jamaica'                            => __( 'Jamaica', 'exclusive-addons-elementor' ),
                'Japan'                              => __( 'Japan', 'exclusive-addons-elementor' ),
                'Jordan'                             => __( 'Jordan', 'exclusive-addons-elementor' ),
                'Kazakhstan'                         => __( 'Kazakhstan', 'exclusive-addons-elementor' ),
                'Kenya'                              => __( 'Kenya', 'exclusive-addons-elementor' ),
                'Kuwait'                             => __( 'Kuwait', 'exclusive-addons-elementor' ),
                'Kyrgyzstan'                         => __( 'Kyrgyzstan', 'exclusive-addons-elementor' ),
                'Lao People\'s Democratic Republic"' => __( 'Lao People\'s Democratic Republic"', 'exclusive-addons-elementor' ),
                'Latvia'                             => __( 'Latvia', 'exclusive-addons-elementor' ),
                'Lebanon'                            => __( 'Lebanon', 'exclusive-addons-elementor' ),
                'Lesotho'                            => __( 'Lesotho', 'exclusive-addons-elementor' ),
                'Liberia'                            => __( 'Liberia', 'exclusive-addons-elementor' ),
                'Libyan Arab Jamahiriya'             => __( 'Libyan Arab Jamahiriya', 'exclusive-addons-elementor' ),
                'Liechtenstein'                      => __( 'Liechtenstein', 'exclusive-addons-elementor' ),
                'Lithuania'                          => __( 'Lithuania', 'exclusive-addons-elementor' ),
                'Luxembourg'                         => __( 'Luxembourg', 'exclusive-addons-elementor' ),
                'MS Zaandam'                         => __( 'MS Zaandam', 'exclusive-addons-elementor' ),
                'Macao'                              => __( 'Macao', 'exclusive-addons-elementor' ),
                'Macedonia'                          => __( 'Macedonia', 'exclusive-addons-elementor' ),
                'Madagascar'                         => __( 'Madagascar', 'exclusive-addons-elementor' ),
                'Malawi'                             => __( 'Malawi', 'exclusive-addons-elementor' ),
                'Malaysia'                           => __( 'Malaysia', 'exclusive-addons-elementor' ),
                'Maldives'                           => __( 'Maldives', 'exclusive-addons-elementor' ),
                'Mali'                               => __( 'Mali', 'exclusive-addons-elementor' ),
                'Malta'                              => __( 'Malta', 'exclusive-addons-elementor' ),
                'Martinique'                         => __( 'Martinique', 'exclusive-addons-elementor' ),
                'Mauritania'                         => __( 'Mauritania', 'exclusive-addons-elementor' ),
                'Mauritius'                          => __( 'Mauritius', 'exclusive-addons-elementor' ),
                'Mayotte'                            => __( 'Mayotte', 'exclusive-addons-elementor' ),
                'Mexico'                             => __( 'Mexico', 'exclusive-addons-elementor' ),
                'Moldova'                            => __( 'Moldova', 'exclusive-addons-elementor' ),
                'Monaco'                             => __( 'Monaco', 'exclusive-addons-elementor' ),
                'Mongolia'                           => __( 'Mongolia', 'exclusive-addons-elementor' ),
                'Montenegro'                         => __( 'Montenegro', 'exclusive-addons-elementor' ),
                'Montserrat'                         => __( 'Montserrat', 'exclusive-addons-elementor' ),
                'Morocco'                            => __( 'Morocco', 'exclusive-addons-elementor' ),
                'Mozambique'                         => __( 'Mozambique', 'exclusive-addons-elementor' ),
                'Myanmar'                            => __( 'Myanmar', 'exclusive-addons-elementor' ),
                'Namibia'                            => __( 'Namibia', 'exclusive-addons-elementor' ),
                'Nepal'                              => __( 'Nepal', 'exclusive-addons-elementor' ),
                'Netherlands'                        => __( 'Netherlands', 'exclusive-addons-elementor' ),
                'New Caledonia'                      => __( 'New Caledonia', 'exclusive-addons-elementor' ),
                'New Zealand'                        => __( 'New Zealand', 'exclusive-addons-elementor' ),
                'Nicaragua'                          => __( 'Nicaragua', 'exclusive-addons-elementor' ),
                'Niger'                              => __( 'Niger', 'exclusive-addons-elementor' ),
                'Nigeria'                            => __( 'Nigeria', 'exclusive-addons-elementor' ),
                'Norway'                             => __( 'Norway', 'exclusive-addons-elementor' ),
                'Oman'                               => __( 'Oman', 'exclusive-addons-elementor' ),
                'Pakistan'                           => __( 'Pakistan', 'exclusive-addons-elementor' ),
                'Palestine'                          => __( 'Palestine', 'exclusive-addons-elementor' ),
                'Panama'                             => __( 'Panama', 'exclusive-addons-elementor' ),
                'Papua New Guinea'                   => __( 'Papua New Guinea', 'exclusive-addons-elementor' ),
                'Paraguay'                           => __( 'Paraguay', 'exclusive-addons-elementor' ),
                'Peru'                               => __( 'Peru', 'exclusive-addons-elementor' ),
                'Philippines'                        => __( 'Philippines', 'exclusive-addons-elementor' ),
                'Poland'                             => __( 'Poland', 'exclusive-addons-elementor' ),
                'Portugal'                           => __( 'Portugal', 'exclusive-addons-elementor' ),
                'Qatar'                              => __( 'Qatar', 'exclusive-addons-elementor' ),
                'Romania'                            => __( 'Romania', 'exclusive-addons-elementor' ),
                'Russia'                             => __( 'Russia', 'exclusive-addons-elementor' ),
                'Rwanda'                             => __( 'Rwanda', 'exclusive-addons-elementor' ),
                'Réunion'                            => __( 'Réunion', 'exclusive-addons-elementor' ),
                'S. Korea'                           => __( 'S. Korea', 'exclusive-addons-elementor' ),
                'Saint Kitts and Nevis'              => __( 'Saint Kitts and Nevis', 'exclusive-addons-elementor' ),
                'Saint Lucia'                        => __( 'Saint Lucia', 'exclusive-addons-elementor' ),
                'Saint Martin'                       => __( 'Saint Martin', 'exclusive-addons-elementor' ),
                'Saint Pierre Miquelon'              => __( 'Saint Pierre Miquelon', 'exclusive-addons-elementor' ),
                'Saint Vincent and the Grenadines'   => __( 'Saint Vincent and the Grenadines', 'exclusive-addons-elementor' ),
                'San Marino'                         => __( 'San Marino', 'exclusive-addons-elementor' ),
                'Sao Tome and Principe'              => __( 'Sao Tome and Principe', 'exclusive-addons-elementor' ),
                'Saudi Arabia'                       => __( 'Saudi Arabia', 'exclusive-addons-elementor' ),
                'Senegal'                            => __( 'Senegal', 'exclusive-addons-elementor' ),
                'Serbia'                             => __( 'Serbia', 'exclusive-addons-elementor' ),
                'Seychelles'                         => __( 'Seychelles', 'exclusive-addons-elementor' ),
                'Sierra Leone'                       => __( 'Sierra Leone', 'exclusive-addons-elementor' ),
                'Singapore'                          => __( 'Singapore', 'exclusive-addons-elementor' ),
                'Sint Maarten'                       => __( 'Sint Maarten', 'exclusive-addons-elementor' ),
                'Slovakia'                           => __( 'Slovakia', 'exclusive-addons-elementor' ),
                'Slovenia'                           => __( 'Slovenia', 'exclusive-addons-elementor' ),
                'Somalia'                            => __( 'Somalia', 'exclusive-addons-elementor' ),
                'South Africa'                       => __( 'South Africa', 'exclusive-addons-elementor' ),
                'South Sudan'                        => __( 'South Sudan', 'exclusive-addons-elementor' ),
                'Spain'                              => __( 'Spain', 'exclusive-addons-elementor' ),
                'Sri Lanka'                          => __( 'Sri Lanka', 'exclusive-addons-elementor' ),
                'St. Barth'                          => __( 'St. Barth', 'exclusive-addons-elementor' ),
                'Sudan'                              => __( 'Sudan', 'exclusive-addons-elementor' ),
                'Suriname'                           => __( 'Suriname', 'exclusive-addons-elementor' ),
                'Swaziland'                          => __( 'Swaziland', 'exclusive-addons-elementor' ),
                'Sweden'                             => __( 'Sweden', 'exclusive-addons-elementor' ),
                'Switzerland'                        => __( 'Switzerland', 'exclusive-addons-elementor' ),
                'Syrian Arab Republic'               => __( 'Syrian Arab Republic', 'exclusive-addons-elementor' ),
                'Taiwan'                             => __( 'Taiwan', 'exclusive-addons-elementor' ),
                'Tajikistan'                         => __( 'Tajikistan', 'exclusive-addons-elementor' ),
                'Tanzania'                           => __( 'Tanzania', 'exclusive-addons-elementor' ),
                'Thailand'                           => __( 'Thailand', 'exclusive-addons-elementor' ),
                'Timor-Leste'                        => __( 'Timor-Leste', 'exclusive-addons-elementor' ),
                'Togo'                               => __( 'Togo', 'exclusive-addons-elementor' ),
                'Trinidad and Tobago'                => __( 'Trinidad and Tobago', 'exclusive-addons-elementor' ),
                'Tunisia'                            => __( 'Tunisia', 'exclusive-addons-elementor' ),
                'Turkey'                             => __( 'Turkey', 'exclusive-addons-elementor' ),
                'Turks and Caicos Islands'           => __( 'Turks and Caicos Islands', 'exclusive-addons-elementor' ),
                'UAE'                                => __( 'UAE', 'exclusive-addons-elementor' ),
                'UK'                                 => __( 'UK', 'exclusive-addons-elementor' ),
                'USA'                                => __( 'USA', 'exclusive-addons-elementor' ),
                'Uganda'                             => __( 'Uganda', 'exclusive-addons-elementor' ),
                'Ukraine'                            => __( 'Ukraine', 'exclusive-addons-elementor' ),
                'Uruguay'                            => __( 'Uruguay', 'exclusive-addons-elementor' ),
                'Uzbekistan'                         => __( 'Uzbekistan', 'exclusive-addons-elementor' ),
                'Venezuela'                          => __( 'Venezuela', 'exclusive-addons-elementor' ),
                'Vietnam'                            => __( 'Vietnam', 'exclusive-addons-elementor' ),
                'Western Sahara'                     => __( 'Western Sahara', 'exclusive-addons-elementor' ),
                'Yemen'                              => __( 'Yemen', 'exclusive-addons-elementor' ),
                'Zambia'                             => __( 'Zambia', 'exclusive-addons-elementor' ),
                'Zimbabwe'                           => __( 'Zimbabwe', 'exclusive-addons-elementor' ),
            ],
        ]
    );

    $this->add_control(
        'exad_heading_title_html_tag',
        [
            'label'   => __('Country HTML Tag', 'exclusive-addons-elementor'),
            'type'    => Controls_Manager::SELECT,
            'separator' => 'after',
            'options' => Helper::exad_title_tags(),
            'default' => 'h2',
        ]
    );

        $this->add_control(
            'exad_corona_columns',
            [
                'label'   => __( 'Columns', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'exad-col-4',
                'options' => [
                    'exad-col-1' => __( '1', 'exclusive-addons-elementor' ),
                    'exad-col-2' => __( '2',   'exclusive-addons-elementor' ),
                    'exad-col-3' => __( '3', 'exclusive-addons-elementor' ),
                    'exad-col-4' => __( '4',  'exclusive-addons-elementor '),
                    'exad-col-5' => __( '5',  'exclusive-addons-elementor '),
                    'exad-col-6' => __( '6',  'exclusive-addons-elementor ')
                ]
            ]
        );

        $this->add_control(
            'exad_corona_enable_last_update',
            [
                'label'        => __( 'Enable Last Update Time', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'exad_corona_update_text',
            [
                'label'     => __( 'Updated Text', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'Last Updated: ', 'exclusive-addons-elementor' ),
                'condition' => [
                    'exad_corona_enable_last_update' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'exad_corona_date_format',
            [
                'label'   => __( 'Date Format', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'Y/m/d h:i A',
                'options' => [
                    'Y/m/d h:i A' => __( 'Y/m/d h:i A', 'exclusive-addons-elementor' ),
                    'Y-m-d h:i A' => __( 'Y-m-d h:i A',   'exclusive-addons-elementor' ),
                    'Y/M/d h:i A' => __( 'Y/M/d h:i A', 'exclusive-addons-elementor' ),
                    'Y/M/d' => __( 'Y/M/d',  'exclusive-addons-elementor' ),
                    'd-M-y' => __( 'd-M-y',  'exclusive-addons-elementor ')
                ],
                'condition' => [
                    'exad_corona_enable_last_update' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'exad_corona_enable_country',
            [
                'label'        => __( 'Enable Country Name', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'exad_corona_enable_total_cases',
            [
                'label'        => __( 'Enable Total Cases', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'exad_corona_enable_total_deaths',
            [
                'label'        => __( 'Enable Total Deaths', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'exad_corona_enable_total_recovered',
            [
                'label'        => __( 'Enable Total Recovered', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'exad_corona_enable_total_active',
            [
                'label'        => __( 'Enable Total Active', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'exad_corona_enable_today_cases',
            [
                'label'        => __( 'Enable Today Cases', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'exad_corona_enable_today_deaths',
            [
                'label'        => __( 'Enable Today Deaths', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'exad_corona_enable_critical',
            [
                'label'        => __( 'Enable Critical', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'exad_corona_enable_total_tests',
            [
                'label'        => __( 'Enable Tests', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'exad_section_corona_info_table',
            [
                'label'  => __( 'Info Table', 'exclusive-addons-elementor' ),
            ]
        );

        $this->add_control(
            'exad_corona_enable_data_table',
            [
                'label'        => __( 'Enable Info Table', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'exclusive-addons-elementor' ),
                'label_off'    => __( 'Hide', 'exclusive-addons-elementor' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $this->add_control(
            'exad_corona_data_table_column',
            [
                'label'       => __( 'Info Table Columns', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                'options'     => [
                    'country'            => __( 'Country', 'exclusive-addons-elementor' ),
                    'cases'              => __( 'Total Cases', 'exclusive-addons-elementor' ),
                    'todayCases'         => __( 'New Cases', 'exclusive-addons-elementor' ),
                    'deaths'             => __( 'Total Deaths', 'exclusive-addons-elementor' ),
                    'todayDeaths'        => __( 'New Deaths', 'exclusive-addons-elementor' ),
                    'recovered'          => __( 'Total Recovered', 'exclusive-addons-elementor' ),
                    'active'             => __( 'Active', 'exclusive-addons-elementor' ),
                    'critical'           => __( 'Critical', 'exclusive-addons-elementor' ),
                    'tests'              => __( 'Total Tests', 'exclusive-addons-elementor' ),
                    'testsPerOneMillion' => __( 'Tests/1M', 'exclusive-addons-elementor' ),
                    'population'         => __( 'Population', 'exclusive-addons-elementor' ),
                ],
                'default'     => [
                    'country',
                    'cases',
                    'todayCases',
                    'deaths',
                    'todayDeaths',
                    'active',
                    'tests',
                ],
                'condition'   => [
                    'exad_corona_enable_data_table' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'exad_corona_enable_search_filter',
            [
                'label'        => __( 'Enable Search Filter', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'exclusive-addons-elementor' ),
                'label_off'    => __( 'Hide', 'exclusive-addons-elementor' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'exad_corona_enable_data_table' => 'yes',
                ],
            ]
        );

        $this->add_control(
			'exad_corona_enable_search_filter_text',
			[
				'label' => __( 'Search Filter Placeholder Text', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
				'default' => __( 'Search by country name', 'exclusive-addons-elementor' ),
                'condition'    => [
                    'exad_corona_enable_search_filter' => 'yes',
                    'exad_corona_enable_data_table' => 'yes'
                ],
			]
		);

        $this->add_control(
            'exad_corona_enable_continent_menu',
            [
                'label'        => __( 'Enable Continent Filter', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'exclusive-addons-elementor' ),
                'label_off'    => __( 'Hide', 'exclusive-addons-elementor' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'exad_corona_enable_data_table' => 'yes',
                ],
            ]
        );
		
        $this->end_controls_section();

        $this->start_controls_section(
            'exad_corona_heading',
            [
                'label' => __( 'Heading', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'exad_corona_heading_position',
			[
				'label' => __( 'Position', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'  => __( 'Default', 'exclusive-addons-elementor' ),
					'inline' => __( 'Inline', 'exclusive-addons-elementor' ),
                ],
                'condition' => [
                    'exad_corona_enable_last_update' => 'yes',
                    'exad_corona_enable_country' => 'yes'
                ]
			]
		);

        $this->add_responsive_control(
            'exad_corona_heading_alignment',
            [
                'label'         => __( 'Alignment', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::CHOOSE,
                'toggle'        => false,
                'default'       => 'center',
                'options'       => [
                    'left'      => [
                        'title' => __( 'Left', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-text-align-left'
                    ],
                    'center'    => [
                        'title' => __( 'Center', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-text-align-center'
                    ],
                    'right'     => [
                        'title' => __( 'Right', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-text-align-right'
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .exad-corona-heading' => 'text-align: {{VALUE}};'
                ],
                'condition' => [
                    'exad_corona_heading_position' => 'default'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_corona_heading_margin',
            [
                'label'        => __('Margin', 'exclusive-addons-elementor'),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => ['px', '%'],
                'default'      => [
                    'top'      => '0',
                    'right'    => '0',
                    'bottom'   => '30',
                    'left'     => '0',
                    'isLinked' => false
                ],
                'selectors'    => [
                    '{{WRAPPER}} .exad-corona-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
            'exad_corona_heading_last_update',
            [
                'label'     => __( 'Last Updated', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'exad_corona_enable_last_update' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_corona_heading_last_update_typography',
                'selector' => '{{WRAPPER}} .exad-corona-heading .exad-corona-last-update',
                'condition' => [
                    'exad_corona_enable_last_update' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'exad_corona_heading_last_update_color',
            [
                'label'     => __( 'Text Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .exad-corona-heading .exad-corona-last-update' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'exad_corona_enable_last_update' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_corona_heading_last_update_margin',
            [
                'label'        => __('Margin', 'exclusive-addons-elementor'),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => ['px', '%'],
                'default'      => [
                    'top'      => '0',
                    'right'    => '0',
                    'bottom'   => '0',
                    'left'     => '0',
                    'isLinked' => true
                ],
                'selectors'    => [
                    '{{WRAPPER}} .exad-corona-heading .exad-corona-last-update' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    'exad_corona_enable_last_update' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'exad_corona_heading_country',
            [
                'label'     => __( 'Country', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'exad_corona_enable_country' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_corona_heading_country_typography',
                'selector' => '{{WRAPPER}} .exad-corona-heading .selected-country',
                'condition' => [
                    'exad_corona_enable_country' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'exad_corona_heading_country_color',
            [
                'label'     => __( 'Text Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .exad-corona-heading .selected-country' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'exad_corona_enable_country' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_corona_heading_country_margin',
            [
                'label'        => __('Margin', 'exclusive-addons-elementor'),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => ['px', '%'],
                'default'      => [
                    'top'      => '0',
                    'right'    => '0',
                    'bottom'   => '0',
                    'left'     => '0',
                    'isLinked' => true
                ],
                'selectors'    => [
                    '{{WRAPPER}} .exad-corona-heading .selected-country' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    'exad_corona_enable_country' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'exad_corona_style',
            [
                'label' => __( 'Container Block', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'exad_corona_content_type',
            [
                'label'   => __( 'Type', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'vertical',
                'options' => [
                    'horizontal' => __( 'Horizontal', 'exclusive-addons-elementor' ),
                    'vertical' => __( 'Vertical',   'exclusive-addons-elementor' )
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_corona_container_block_spacing',
            [
                'label'      => __('Block Spacing', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default'    => [
                    'top'    => '0',
                    'right'  => '10',
                    'bottom' => '20',
                    'left'   => '10'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-corona-wrapper .exad-corona-col' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_corona_content_alignment',
            [
                'label'         => __( 'Alignment', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::CHOOSE,
                'toggle'        => false,
                'default'       => 'center',
                'options'       => [
                    'flex-start'      => [
                        'title' => __( 'Left', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-text-align-left'
                    ],
                    'center'    => [
                        'title' => __( 'Center', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-text-align-center'
                    ],
                    'flex-end'     => [
                        'title' => __( 'Right', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-text-align-right'
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .exad-corona-content-vertical' => 'align-items: {{VALUE}};',
                    '{{WRAPPER}} .exad-corona-content-horizontal' => 'justify-content: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'exad_corona_items_background',
                'label'    => __( 'Background', 'exclusive-addons-elementor' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .exad-corona-item-inner',
            ]
        );

        $this->add_responsive_control(
            'exad_corona_item_padding',
            [
                'label'      => __('Padding', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'    => [
                    'top'    => '20',
                    'right'  => '20',
                    'bottom' => '20',
                    'left'   => '20'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-corona-item-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'               => 'exad_corona_item_border',
                'fields_options'     => [
                    'border'         => [
                        'default'    => 'solid'
                    ],
                    'width'          => [
                        'default'    => [
                            'top'    => '1',
                            'right'  => '1',
                            'bottom' => '1',
                            'left'   => '1'
                        ]
                    ],
                    'color'          => [
                        'default'    => '#000000'
                    ]
                ],
                'selector'           => '{{WRAPPER}} .exad-corona-item-inner'
            ]
        );

        $this->add_responsive_control(
            'exad_corona_item_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .exad-corona-item-inner'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'exad_corona_item_box_shadow',
                'selector' => '{{WRAPPER}} .exad-corona-item-inner'
            ]
        );

        $this->add_control(
            'exad_corona_item_label_style',
            [
                'label'     => __( 'Label', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_corona_item_label_typography',
                'selector' => '{{WRAPPER}} .exad-corona-label'
            ]
        );

        $this->add_control(
            'exad_corona_item_label_color',
            [
                'label'     => __( 'Text Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .exad-corona-label' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'exad_corona_item_label_space_between',
            [
                'label'        => esc_html__( 'Space Between', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SLIDER,
                'default'      => [
                    'size'     => 10,
                    'unit'     => 'px'
                ],  
                'selectors'    => [
                    '{{WRAPPER}} .exad-corona-content-horizontal .exad-corona-label' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .exad-corona-content-vertical .exad-corona-label' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],              
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 30,
                        'step' => 1
                    ]
                ]
            ]
        );

        $this->add_control(
            'exad_corona_item_data_style',
            [
                'label'     => __( 'Data', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_corona_item_data_typography',
                'selector' => '{{WRAPPER}} .exad-corona-data'
            ]
        );

        $this->add_control(
            'exad_corona_item_data_color',
            [
                'label'     => __( 'Text Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .exad-corona-data' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'exad_corona_search_filter_style',
            [
                'label' => __( 'Search Filter', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'exad_corona_enable_search_filter' => 'yes',
                    'exad_corona_enable_data_table' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
			'exad_corona_search_filter_width',
			[
				'label' => __( 'Input Box Width', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 600,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 350,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-corona-search-form' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'exad_corona_search_filter_height',
			[
				'label' => __( 'Input Box Height', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 30,
						'max' => 80,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-corona-search-form' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'exad_corona_search_filter_background',
            [
                'label'     => __( 'Background', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exad-corona-search-form .exad-corona-search-input' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_corona_search_filter_typography',
                'selector' => '{{WRAPPER}} .exad-corona-search-form .exad-corona-search-input'
            ]
        );

        $this->add_control(
            'exad_corona_search_filter_text_color',
            [
                'label'     => __( 'Text Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exad-corona-search-form .exad-corona-search-input' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'exad_corona_search_filter_placeholder_color',
            [
                'label'     => __( 'Placeholder Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exad-corona-search-form .exad-corona-search-input::placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .exad-corona-search-form .exad-corona-search-icon' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'exad_corona_search_filter_border',
                'label' => __( 'Border', 'exclusive-addons-elementor' ),
                'selector' => '{{WRAPPER}} .exad-corona-search-form .exad-corona-search-input',
            ]
        );

        $this->add_responsive_control(
			'exad_corona_search_filter_radius',
			[
				'label' => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
				'selectors' => [
					'{{WRAPPER}} .exad-corona-search-form .exad-corona-search-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'exad_corona_search_filter_padding',
			[
				'label' => __( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '40',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
				'selectors' => [
					'{{WRAPPER}} .exad-corona-search-form .exad-corona-search-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'exad_corona_search_filter_margin',
			[
				'label' => __( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '20',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
				'selectors' => [
					'{{WRAPPER}} .exad-corona-search-form' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'exad_corona_search_filter_search_icon_position',
			[
				'label' => __( 'Search Icon Position', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 12,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-corona-search-form .exad-corona-search-icon' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
        );
        
        $this->add_responsive_control(
			'exad_corona_search_filter_search_icon_size',
			[
				'label' => __( 'Search Icon Size', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-corona-search-form .exad-corona-search-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'exad_corona_search_filter_box_shadow',
                'selector' => '{{WRAPPER}} .exad-corona-search-form .exad-corona-search-input'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'exad_corona_continent_menu',
            [
                'label' => __( 'Continent Filter Button', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'exad_corona_enable_continent_menu' => 'yes',
                    'exad_corona_enable_data_table' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_corona_continent_menu_typography',
                'selector' => '{{WRAPPER}} .exad-covid-continent-btn'
            ]
        );

        $this->add_responsive_control(
			'exad_corona_continent_menu_margin',
			[
				'label' => __( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'top' => '0',
                    'right' => '10',
                    'bottom' => '20',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
				'selectors' => [
					'{{WRAPPER}} .exad-covid-continent-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'exad_corona_continent_menu_padding',
			[
				'label' => __( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'top' => '10',
                    'right' => '20',
                    'bottom' => '10',
                    'left' => '20',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
				'selectors' => [
					'{{WRAPPER}} .exad-covid-continent-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
        
        $this->add_responsive_control(
			'exad_corona_continent_menu_radius',
			[
				'label' => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
				'selectors' => [
					'{{WRAPPER}} .exad-covid-continent-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->start_controls_tabs( 'exad_corona_continent_menu_tab' );

            // Odd state tab
            $this->start_controls_tab( 'exad_corona_continent_menu_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

                $this->add_control(
                    'exad_corona_continent_menu_normal_bg_color',
                    [
                        'label'     => __( 'Background', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .exad-covid-continent-btn' => 'background-color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'exad_corona_continent_menu_normal_text_color',
                    [
                        'label'     => __( 'Text Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#7a56ff',
                        'selectors' => [
                            '{{WRAPPER}} .exad-covid-continent-btn' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'exad_corona_continent_menu_normal_border',
                        'label' => __( 'Border', 'exclusive-addons-elementor' ),
                        'fields_options'  => [
                            'border'      => [
                                'default' => 'solid'
                            ],
                            'width'          => [
                                'default'    => [
                                    'top'    => '1',
                                    'right'  => '1',
                                    'bottom' => '1',
                                    'left'   => '1'
                                ]
                            ],
                            'color'       => [
                                'default' => '#7a56ff'
                            ]
                        ],
                        'selector' => '{{WRAPPER}} .exad-covid-continent-btn',
                    ]
                );

            $this->end_controls_tab();

            // Even state tab
            $this->start_controls_tab( 'exad_corona_continent_menu_active', [ 'label' => esc_html__( 'Hover/active', 'exclusive-addons-elementor' ) ] );

                $this->add_control(
                    'exad_corona_continent_menu_active_bg_color',
                    [
                        'label'     => __( 'Background', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#7a56ff',
                        'selectors' => [
                            '{{WRAPPER}} .exad-covid-continent-btn.active' => 'background-color: {{VALUE}};',
                            '{{WRAPPER}} .exad-covid-continent-btn:hover' => 'background-color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'exad_corona_continent_menu_active_text_color',
                    [
                        'label'     => __( 'Text Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .exad-covid-continent-btn.active' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .exad-covid-continent-btn:hover' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'exad_corona_continent_menu_active_border',
                        'label' => __( 'Border', 'exclusive-addons-elementor' ),
                        'fields_options'  => [
                            'border'      => [
                                'default' => 'solid'
                            ],
                            'width'          => [
                                'default'    => [
                                    'top'    => '1',
                                    'right'  => '1',
                                    'bottom' => '1',
                                    'left'   => '1'
                                ]
                            ],
                            'color'       => [
                                'default' => '#7a56ff'
                            ]
                        ],
                        'selector' => '{{WRAPPER}} .exad-covid-continent-btn.active',
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'exad_corona_data_table_style',
            [
                'label' => __( 'Info Table', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'exad_corona_enable_data_table' => 'yes'
                ]
            ]
        );

        $this->add_control(
			'exad_corona_enable_data_table_box',
			[
				'label' => __( 'Table Box', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'exclusive-addons-elementor' ),
				'label_off' => __( 'Hide', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
                'default' => 'no',
			]
        );
        
        $this->add_responsive_control(
            'exad_corona_enable_data_table_box_width',
            [
                'label'        => esc_html__( 'Box Width', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 100,
                        'max'  => 1000,
                        'step' => 1
                    ]
                ],
                'default'      => [
                    'size'     => 500,
                    'unit'     => 'px'
                ],
                'selectors'    => [
                    '{{WRAPPER}} .exad-corona-table.yes' => 'Height: {{SIZE}}{{UNIT}};',
                ],              
                'condition' => [
                    'exad_corona_enable_data_table_box' => 'yes' 
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_corona_data_table_alignment',
            [
                'label'         => __( 'Alignment', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::CHOOSE,
                'toggle'        => false,
                'default'       => 'left',
                'options'       => [
                    'left'      => [
                        'title' => __( 'Left', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-text-align-left'
                    ],
                    'center'    => [
                        'title' => __( 'Center', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-text-align-center'
                    ],
                    'right'     => [
                        'title' => __( 'Right', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-text-align-right'
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .exad-data-table' => 'text-align: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'exad_corona_data_table_heading',
            [
                'label'     => __( 'Table Heading', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_control(
			'exad_corona_enable_data_table_heading_sticky',
			[
				'label' => __( 'Sticky Heading', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'exclusive-addons-elementor' ),
				'label_off' => __( 'Hide', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
                'default' => 'no',
			]
		);

        $this->add_control(
            'exad_corona_data_table_heading_bg_color',
            [
                'label'     => __( 'Background', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#e3e3e3',
                'selectors' => [
                    '{{WRAPPER}} .exad-data-table .exad-corona-table-heading th' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_corona_data_table_heading_typography',
                'label'    => __( 'Typography', 'exclusive-addons-elementor' ),
                'selector' => '{{WRAPPER}} .exad-data-table .exad-corona-table-heading th',
            ]
        );

        $this->add_control(
            'exad_corona_data_table_heading_text_color',
            [
                'label'     => __( 'Text Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exad-data-table .exad-corona-table-heading th' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_corona_data_table_heading_border',
				'label' => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-data-table .exad-corona-table-heading th',
			]
        );
        
        $this->add_responsive_control(
			'exad_corona_data_table_heading_padding',
			[
				'label' => __( 'Table Heading Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'top' => '15',
                    'right' => '15',
                    'bottom' => '15',
                    'left' => '15',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
				'selectors' => [
					'{{WRAPPER}} .exad-data-table .exad-corona-table-heading th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'exad_corona_data_table_row',
            [
                'label'     => __( 'Data Row', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
			'exad_corona_data_table_row_padding',
			[
				'label' => __( 'Row Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'top' => '15',
                    'right' => '15',
                    'bottom' => '15',
                    'left' => '15',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
				'selectors' => [
					'{{WRAPPER}} .exad-data-table .exad-data-table-row td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->start_controls_tabs( 'exad_corona_data_table_row_tabs' );

            // Odd state tab
            $this->start_controls_tab( 'exad_corona_data_table_row_odd', [ 'label' => esc_html__( 'Odd Row', 'exclusive-addons-elementor' ) ] );

                $this->add_control(
                    'exad_corona_data_table_row_odd_bg_color',
                    [
                        'label'     => __( 'Odd Row Background', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .exad-data-table .exad-data-table-row:nth-child(odd) td' => 'background-color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name'     => 'exad_corona_data_table_row_odd_typography',
                        'label'    => __( 'Typography', 'exclusive-addons-elementor' ),
                        'selector' => '{{WRAPPER}} .exad-data-table .exad-data-table-row:nth-child(odd) td',
                    ]
                );

                $this->add_control(
                    'exad_corona_data_table_row_odd_text_color',
                    [
                        'label'     => __( 'Text Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .exad-data-table .exad-data-table-row:nth-child(odd) td' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'exad_corona_data_table_row_odd_border',
                        'label' => __( 'Border', 'exclusive-addons-elementor' ),
                        'selector' => '{{WRAPPER}} .exad-data-table .exad-data-table-row:nth-child(odd) td',
                    ]
                );

            $this->end_controls_tab();

            // Even state tab
            $this->start_controls_tab( 'exad_corona_data_table_row_even', [ 'label' => esc_html__( 'Even Row', 'exclusive-addons-elementor' ) ] );

                $this->add_control(
                    'exad_corona_data_table_row_even_bg_color',
                    [
                        'label'     => __( 'Even Row Background', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#eee',
                        'selectors' => [
                            '{{WRAPPER}} .exad-data-table .exad-data-table-row:nth-child(even) td' => 'background-color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name'     => 'exad_corona_data_table_row_even_typography',
                        'label'    => __( 'Typography', 'exclusive-addons-elementor' ),
                        'selector' => '{{WRAPPER}} .exad-data-table .exad-data-table-row:nth-child(even) td',
                    ]
                );

                $this->add_control(
                    'exad_corona_data_table_row_even_text_color',
                    [
                        'label'     => __( 'Text Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .exad-data-table .exad-data-table-row:nth-child(even) td' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'exad_corona_data_table_row_even_border',
                        'label' => __( 'Border', 'exclusive-addons-elementor' ),
                        'selector' => '{{WRAPPER}} .exad-data-table .exad-data-table-row:nth-child(even) td',
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    /**
	 * @access protected
	 */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $country = $settings['exad_section_corona_country_base'];
        $last_update = $settings['exad_corona_enable_last_update'];

        $args = array(
            'user-agent'  =>  'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8) AppleWebKit/535.6.2 (KHTML, like Gecko) Version/5.2 Safari/535.6.2',
            'sslverify' => false,
        ); 

        if( 'All' === $country ) {
            $response = wp_remote_get( sprintf( 'https://disease.sh/v3/covid-19/%s', $country ), $args );
        } else {
            $response = wp_remote_get( sprintf( 'https://disease.sh/v3/covid-19/countries/%s', $country ), $args );
        }
        $info_block_data = json_decode( wp_remote_retrieve_body( $response ), true );

        // API response for Info Table
        $all_response = wp_remote_get( 'https://disease.sh/v3/covid-19/countries', $args );
        $info_table_data = json_decode( wp_remote_retrieve_body( $all_response ), true );

            $last_updated_time = $settings['exad_corona_date_format'];
            $last_updated_text = $settings['exad_corona_update_text'];
            $dateformat1 = intval( $info_block_data['updated']/1000 );
            $dateformat2 = date( $last_updated_time, $dateformat1 );
        ?>
        
        <div class="exad-corona">
            <div class="exad-corona-heading <?php echo esc_attr( $settings['exad_corona_heading_position'] ); ?>">
                <?php if( 'yes' === $last_update ) { ?>
                    <div class="exad-corona-last-update">
                        <?php echo esc_html( $last_updated_text );  ?>
                        <span><?php echo esc_html( $dateformat2 ); ?></span>
                    </div>
                <?php } ?>
                <?php if( 'yes' === $settings['exad_corona_enable_country'] ) { ?>
                    <<?php echo Utils::validate_html_tag( $settings['exad_heading_title_html_tag'] ); ?> class="selected-country"><?php echo esc_html( $settings['exad_section_corona_country_base'] ); ?></<?php echo Utils::validate_html_tag( $settings['exad_heading_title_html_tag'] ); ?>>
                <?php } ?>
            </div>
        
        <div class="exad-corona-wrapper <?php echo esc_attr( $settings['exad_corona_columns'] ); ?>">
            <?php if( 'yes' === $settings['exad_corona_enable_total_cases'] ) : ?>
                <div class="exad-corona-each-item exad-corona-col">
                    <div class="exad-corona-item-inner exad-corona-content-<?php echo esc_attr( $settings['exad_corona_content_type'] );?>">
                        <span class="exad-corona-label"><?php _e( 'Cases: ', 'exclusive-addons-elementor' ); ?></span>
                        <span class="exad-corona-data"><?php echo esc_html( $info_block_data['cases'] ); ?></span>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if( 'yes' === $settings['exad_corona_enable_total_deaths'] ) : ?>
                <div class="exad-corona-each-item exad-corona-col">
                    <div class="exad-corona-item-inner exad-corona-content-<?php echo esc_attr( $settings['exad_corona_content_type'] );?>">
                        <span class="exad-corona-label"><?php _e( 'Deaths: ', 'exclusive-addons-elementor' ); ?></span>
                        <span class="exad-corona-data"><?php echo esc_html( $info_block_data['deaths'] ); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <?php if( 'yes' === $settings['exad_corona_enable_total_recovered'] ) : ?>
                <div class="exad-corona-each-item exad-corona-col">
                    <div class="exad-corona-item-inner exad-corona-content-<?php echo esc_attr( $settings['exad_corona_content_type'] );?>">
                        <span class="exad-corona-label"><?php _e( 'Recovered: ', 'exclusive-addons-elementor' ); ?></span>
                        <span class="exad-corona-data"><?php echo esc_html( $info_block_data['recovered'] ); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <?php if( 'yes' === $settings['exad_corona_enable_total_active'] ) : ?>
                <div class="exad-corona-each-item exad-corona-col">
                    <div class="exad-corona-item-inner exad-corona-content-<?php echo esc_attr( $settings['exad_corona_content_type'] );?>">
                        <span class="exad-corona-label"><?php _e( 'Active: ', 'exclusive-addons-elementor' ); ?></span>
                        <span class="exad-corona-data"><?php echo esc_html( $info_block_data['active'] ); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <?php if( 'yes' === $settings['exad_corona_enable_today_cases'] ) : ?>
                <div class="exad-corona-each-item exad-corona-col">
                    <div class="exad-corona-item-inner exad-corona-content-<?php echo esc_attr( $settings['exad_corona_content_type'] );?>">
                        <span class="exad-corona-label"><?php _e( 'Cases Today: ', 'exclusive-addons-elementor' ); ?></span>
                        <span class="exad-corona-data"><?php echo esc_html( $info_block_data['todayCases'] ); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <?php if( 'yes' === $settings['exad_corona_enable_today_deaths'] ) : ?>
                <div class="exad-corona-each-item exad-corona-col">
                    <div class="exad-corona-item-inner exad-corona-content-<?php echo esc_attr( $settings['exad_corona_content_type'] );?>">
                        <span class="exad-corona-label"><?php _e( 'Deaths Today: ', 'exclusive-addons-elementor' ); ?></span>
                        <span class="exad-corona-data"><?php echo esc_html( $info_block_data['todayDeaths'] ); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <?php if( 'yes' === $settings['exad_corona_enable_critical'] ) : ?>
                <div class="exad-corona-each-item exad-corona-col">
                    <div class="exad-corona-item-inner exad-corona-content-<?php echo esc_attr( $settings['exad_corona_content_type'] );?>">
                        <span class="exad-corona-label"><?php _e( 'Critical: ', 'exclusive-addons-elementor' ); ?></span>
                        <span class="exad-corona-data"><?php echo esc_html( $info_block_data['critical'] ); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <?php if( 'yes' === $settings['exad_corona_enable_total_tests'] ) : ?>
                <div class="exad-corona-each-item exad-corona-col">
                    <div class="exad-corona-item-inner exad-corona-content-<?php echo esc_attr( $settings['exad_corona_content_type'] );?>">
                        <span class="exad-corona-label"><?php _e( 'Tests: ', 'exclusive-addons-elementor' ); ?></span>
                        <span class="exad-corona-data"><?php echo esc_html( $info_block_data['tests'] ); ?></span>
                    </div>
                </div>
            <?php endif; ?>
            </div>
            <?php if( 'yes' === $settings['exad_corona_enable_search_filter'] && 'yes' === $settings['exad_corona_enable_data_table'] ) { ?>
                <div class="exad-corona-search-form">
                    <span class="exad-corona-search-icon"><i class="fa fa-search"></i></span>
                    <input class="exad-corona-search-input" type="text" name="search" id="exad_search_data" placeholder="<?php echo esc_attr($settings['exad_corona_enable_search_filter_text']); ?>">
                </div>
            <?php } ?>
            <?php if( 'yes' === $settings['exad_corona_enable_data_table'] ) { ?>
                <div class="exad-corona-table <?php echo $settings['exad_corona_enable_data_table_box'] ?>">
                    <?php if( 'yes' === $settings['exad_corona_enable_continent_menu'] && 'yes' === $settings['exad_corona_enable_data_table'] ) { ?>
                        <div id="exad-covid-filters" class="exed-covid-data-continent">
                            <button class="exad-covid-continent-btn active" id="all">All</button>
                            <button class="exad-covid-continent-btn" id="europe">Europe</button>
                            <button class="exad-covid-continent-btn" id="africa">Africa</button>
                            <button class="exad-covid-continent-btn" id="north-america">North America</button>
                            <button class="exad-covid-continent-btn" id="south-america">South America</button>
                            <button class="exad-covid-continent-btn" id="asia">Asia</button>
                            <button class="exad-covid-continent-btn" id="australia-oceania">Australia/Oceania</button>
                        </div>
                    <?php } ?>
                    <table id="data_table" class="exad-data-table">
                        <tr class="exad-corona-table-heading <?php echo $settings['exad_corona_enable_data_table_heading_sticky'] ?>">
                            <th class="flag-row"><?php _e( 'Flag', 'exclusive-addons-elementor' ); ?></th>
                            <?php foreach ( $settings['exad_corona_data_table_column'] as $option ) { ?>
                                <th>
                                <?php 
                                    switch ($option) {
                                        case "country":
                                        echo "Country";
                                        break;
                                        case "cases":
                                        echo "Total Cases";
                                        break;
                                        case "todayCases":
                                        echo "New Cases";
                                        break;
                                        case "deaths":
                                        echo "Total Deaths";
                                        break;
                                        case "todayDeaths":
                                        echo "New Deaths";
                                        break;
                                        case "recovered":
                                        echo "Total Recovered";
                                        break;
                                        case "active":
                                        echo "Active Cases";
                                        break;
                                        case "critical":
                                        echo "Critical";
                                        break;
                                        case "tests":
                                        echo "Total Tests";
                                        break;
                                        case "testsPerOneMillion":
                                        echo "Tests/1M";
                                        break;
                                        case "population":
                                        echo "Population";
                                        break;
                                    } 
                                ?>
                                </th>
                            <?php } ?>
                        </tr>
                        <?php
                        foreach( $info_table_data as $info_table ) { ?>
                        <tr class="data_table_row exad-data-table-row <?php
                        if( 'yes' === $settings['exad_corona_enable_continent_menu'] && 'yes' === $settings['exad_corona_enable_data_table'] ) {
                            $continent = $info_table['continent'];
                            $low_continent = strtolower($continent);
                            $rep_continent = str_replace( array(' ', '/'), "-",$low_continent);
                            echo $rep_continent; 
                        }
                        ?>">
                            <td class="flag"><img src="<?php echo $info_table['countryInfo']["flag"]; ?>" alt="<?php echo $info_table['country']; ?>"></td>
                            <?php foreach ( $settings['exad_corona_data_table_column'] as $value ) { ?>
                                <td><?php echo $info_table[$value]; ?></td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            <?php } ?>
        </div>

        <?php
    }
}