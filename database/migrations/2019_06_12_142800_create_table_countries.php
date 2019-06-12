<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCountries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('iso2', 2);
            $table->string('iso3', 3);
            $table->string('phone_code', 10);
            $table->timestamps();
        });

        $data = json_decode('[
        {
          "country":"Afganistán",
          "iso2":"AF",
          "iso3":"AFG",
          "phoneCode":"+93"
        },
        {
            "country":"Albania",
            "iso2":"AL",
            "iso3":"ALB",
            "phoneCode":"+355"
        },
        {
            "country":"Alemania",
            "iso2":"DE",
            "iso3":"DEU",
            "phoneCode":"+49"
        },
        {
            "country":"Algeria",
            "iso2":"DZ",
            "iso3":"DZA",
            "phoneCode":"+213"
        },
        {
            "country":"Andorra",
            "iso2":"AD",
            "iso3":"AND",
            "phoneCode":"+376"
        },
        {
            "country":"Angola",
            "iso2":"AO",
            "iso3":"AGO",
            "phoneCode":"+244"
        },
        {
            "country":"Anguila",
            "iso2":"AI",
            "iso3":"AIA",
            "phoneCode":"+1 264"
        },
        {
            "country":"Antártida",
            "iso2":"AQ",
            "iso3":"ATA",
            "phoneCode":"+672"
        },
        {
            "country":"Antigua y Barbuda",
            "iso2":"AG",
            "iso3":"ATG",
            "phoneCode":"+1 268"
        },
        {
            "country":"Antillas Neerlandesas",
            "iso2":"AN",
            "iso3":"ANT",
            "phoneCode":"+599"
        },
        {
            "country":"Arabia Saudita",
            "iso2":"SA",
            "iso3":"SAU",
            "phoneCode":"+966"
        },
        {
            "country":"Argentina",
            "iso2":"AR",
            "iso3":"ARG",
            "phoneCode":"+54"
        },
        {
            "country":"Armenia",
            "iso2":"AM",
            "iso3":"ARM",
            "phoneCode":"+374"
        },
        {
            "country":"Aruba",
            "iso2":"AW",
            "iso3":"ABW",
            "phoneCode":"+297"
        },
        {
            "country":"Australia",
            "iso2":"AU",
            "iso3":"AUS",
            "phoneCode":"+61"
        },
        {
            "country":"Austria",
            "iso2":"AT",
            "iso3":"AUT",
            "phoneCode":"+43"
        },
        {
            "country":"Azerbayán",
            "iso2":"AZ",
            "iso3":"AZE",
            "phoneCode":"+994"
        },
        {
            "country":"Bélgica",
            "iso2":"BE",
            "iso3":"BEL",
            "phoneCode":"+32"
        },
        {
            "country":"Bahamas",
            "iso2":"BS",
            "iso3":"BHS",
            "phoneCode":"+1 242"
        },
        {
            "country":"Bahrein",
            "iso2":"BH",
            "iso3":"BHR",
            "phoneCode":"+973"
        },
        {
            "country":"Bangladesh",
            "iso2":"BD",
            "iso3":"BGD",
            "phoneCode":"+880"
        },
        {
            "country":"Barbados",
            "iso2":"BB",
            "iso3":"BRB",
            "phoneCode":"+1 246"
        },
        {
            "country":"Belice",
            "iso2":"BZ",
            "iso3":"BLZ",
            "phoneCode":"+501"
        },
        {
            "country":"Benín",
            "iso2":"BJ",
            "iso3":"BEN",
            "phoneCode":"+229"
        },
        {
            "country":"Bhután",
            "iso2":"BT",
            "iso3":"BTN",
            "phoneCode":"+975"
        },
        {
            "country":"Bielorrusia",
            "iso2":"BY",
            "iso3":"BLR",
            "phoneCode":"+375"
        },
        {
            "country":"Birmania",
            "iso2":"MM",
            "iso3":"MMR",
            "phoneCode":"+95"
        },
        {
            "country":"Bolivia",
            "iso2":"BO",
            "iso3":"BOL",
            "phoneCode":"+591"
        },
        {
            "country":"Bosnia y Herzegovina",
            "iso2":"BA",
            "iso3":"BIH",
            "phoneCode":"+387"
        },
        {
            "country":"Botsuana",
            "iso2":"BW",
            "iso3":"BWA",
            "phoneCode":"+267"
        },
        {
            "country":"Brasil",
            "iso2":"BR",
            "iso3":"BRA",
            "phoneCode":"+55"
        },
        {
            "country":"Brunéi",
            "iso2":"BN",
            "iso3":"BRN",
            "phoneCode":"+673"
        },
        {
            "country":"Bulgaria",
            "iso2":"BG",
            "iso3":"BGR",
            "phoneCode":"+359"
        },
        {
            "country":"Burkina Faso",
            "iso2":"BF",
            "iso3":"BFA",
            "phoneCode":"+226"
        },
        {
            "country":"Burundi",
            "iso2":"BI",
            "iso3":"BDI",
            "phoneCode":"+257"
        },
        {
            "country":"Cabo Verde",
            "iso2":"CV",
            "iso3":"CPV",
            "phoneCode":"+238"
        },
        {
            "country":"Camboya",
            "iso2":"KH",
            "iso3":"KHM",
            "phoneCode":"+855"
        },
        {
            "country":"Camerún",
            "iso2":"CM",
            "iso3":"CMR",
            "phoneCode":"+237"
        },
        {
            "country":"Canadá",
            "iso2":"CA",
            "iso3":"CAN",
            "phoneCode":"+1"
        },
        {
            "country":"Chad",
            "iso2":"TD",
            "iso3":"TCD",
            "phoneCode":"+235"
        },
        {
            "country":"Chile",
            "iso2":"CL",
            "iso3":"CHL",
            "phoneCode":"+56"
        },
        {
            "country":"China",
            "iso2":"CN",
            "iso3":"CHN",
            "phoneCode":"+86"
        },
        {
            "country":"Chipre",
            "iso2":"CY",
            "iso3":"CYP",
            "phoneCode":"+357"
        },
        {
            "country":"Ciudad del Vaticano",
            "iso2":"VA",
            "iso3":"VAT",
            "phoneCode":"+39"
        },
        {
            "country":"Colombia",
            "iso2":"CO",
            "iso3":"COL",
            "phoneCode":"+57"
        },
        {
            "country":"Comoras",
            "iso2":"KM",
            "iso3":"COM",
            "phoneCode":"+269"
        },
        {
            "country":"Congo",
            "iso2":"CG",
            "iso3":"COG",
            "phoneCode":"+242"
        },
        {
            "country":"Congo",
            "iso2":"CD",
            "iso3":"COD",
            "phoneCode":"+243"
        },
        {
            "country":"Corea del Norte",
            "iso2":"KP",
            "iso3":"PRK",
            "phoneCode":"+850"
        },
        {
            "country":"Corea del Sur",
            "iso2":"KR",
            "iso3":"KOR",
            "phoneCode":"+82"
        },
        {
            "country":"Costa de Marfil",
            "iso2":"CI",
            "iso3":"CIV",
            "phoneCode":"+225"
        },
        {
            "country":"Costa Rica",
            "iso2":"CR",
            "iso3":"CRI",
            "phoneCode":"+506"
        },
        {
            "country":"Croacia",
            "iso2":"HR",
            "iso3":"HRV",
            "phoneCode":"+385"
        },
        {
            "country":"Cuba",
            "iso2":"CU",
            "iso3":"CUB",
            "phoneCode":"+53"
        },
        {
            "country":"Dinamarca",
            "iso2":"DK",
            "iso3":"DNK",
            "phoneCode":"+45"
        },
        {
            "country":"Dominica",
            "iso2":"DM",
            "iso3":"DMA",
            "phoneCode":"+1 767"
        },
        {
            "country":"Ecuador",
            "iso2":"EC",
            "iso3":"ECU",
            "phoneCode":"+593"
        },
        {
            "country":"Egipto",
            "iso2":"EG",
            "iso3":"EGY",
            "phoneCode":"+20"
        },
        {
            "country":"El Salvador",
            "iso2":"SV",
            "iso3":"SLV",
            "phoneCode":"+503"
        },
        {
            "country":"Emiratos Árabes Unidos",
            "iso2":"AE",
            "iso3":"ARE",
            "phoneCode":"+971"
        },
        {
            "country":"Eritrea",
            "iso2":"ER",
            "iso3":"ERI",
            "phoneCode":"+291"
        },
        {
            "country":"Eslovaquia",
            "iso2":"SK",
            "iso3":"SVK",
            "phoneCode":"+421"
        },
        {
            "country":"Eslovenia",
            "iso2":"SI",
            "iso3":"SVN",
            "phoneCode":"+386"
        },
        {
            "country":"España",
            "iso2":"ES",
            "iso3":"ESP",
            "phoneCode":"+34"
        },
        {
            "country":"Estados Unidos de América",
            "iso2":"US",
            "iso3":"USA",
            "phoneCode":"+1"
        },
        {
            "country":"Estonia",
            "iso2":"EE",
            "iso3":"EST",
            "phoneCode":"+372"
        },
        {
            "country":"Etiopía",
            "iso2":"ET",
            "iso3":"ETH",
            "phoneCode":"+251"
        },
        {
            "country":"Filipinas",
            "iso2":"PH",
            "iso3":"PHL",
            "phoneCode":"+63"
        },
        {
            "country":"Finlandia",
            "iso2":"FI",
            "iso3":"FIN",
            "phoneCode":"+358"
        },
        {
            "country":"Fiyi",
            "iso2":"FJ",
            "iso3":"FJI",
            "phoneCode":"+679"
        },
        {
            "country":"Francia",
            "iso2":"FR",
            "iso3":"FRA",
            "phoneCode":"+33"
        },
        {
            "country":"Gabón",
            "iso2":"GA",
            "iso3":"GAB",
            "phoneCode":"+241"
        },
        {
            "country":"Gambia",
            "iso2":"GM",
            "iso3":"GMB",
            "phoneCode":"+220"
        },
        {
            "country":"Georgia",
            "iso2":"GE",
            "iso3":"GEO",
            "phoneCode":"+995"
        },
        {
            "country":"Ghana",
            "iso2":"GH",
            "iso3":"GHA",
            "phoneCode":"+233"
        },
        {
            "country":"Gibraltar",
            "iso2":"GI",
            "iso3":"GIB",
            "phoneCode":"+350"
        },
        {
            "country":"Granada",
            "iso2":"GD",
            "iso3":"GRD",
            "phoneCode":"+1 473"
        },
        {
            "country":"Grecia",
            "iso2":"GR",
            "iso3":"GRC",
            "phoneCode":"+30"
        },
        {
            "country":"Groenlandia",
            "iso2":"GL",
            "iso3":"GRL",
            "phoneCode":"+299"
        },
        {
            "country":"Guadalupe",
            "iso2":"GP",
            "iso3":"GLP",
            "phoneCode":"+"
        },
        {
            "country":"Guam",
            "iso2":"GU",
            "iso3":"GUM",
            "phoneCode":"+1 671"
        },
        {
            "country":"Guatemala",
            "iso2":"GT",
            "iso3":"GTM",
            "phoneCode":"+502"
        },
        {
            "country":"Guayana Francesa",
            "iso2":"GF",
            "iso3":"GUF",
            "phoneCode":"+"
        },
        {
            "country":"Guernsey",
            "iso2":"GG",
            "iso3":"GGY",
            "phoneCode":"+"
        },
        {
            "country":"Guinea",
            "iso2":"GN",
            "iso3":"GIN",
            "phoneCode":"+224"
        },
        {
            "country":"Guinea Ecuatorial",
            "iso2":"GQ",
            "iso3":"GNQ",
            "phoneCode":"+240"
        },
        {
            "country":"Guinea-Bissau",
            "iso2":"GW",
            "iso3":"GNB",
            "phoneCode":"+245"
        },
        {
            "country":"Guyana",
            "iso2":"GY",
            "iso3":"GUY",
            "phoneCode":"+592"
        },
        {
            "country":"Haití",
            "iso2":"HT",
            "iso3":"HTI",
            "phoneCode":"+509"
        },
        {
            "country":"Honduras",
            "iso2":"HN",
            "iso3":"HND",
            "phoneCode":"+504"
        },
        {
            "country":"Hong kong",
            "iso2":"HK",
            "iso3":"HKG",
            "phoneCode":"+852"
        },
        {
            "country":"Hungría",
            "iso2":"HU",
            "iso3":"HUN",
            "phoneCode":"+36"
        },
        {
            "country":"India",
            "iso2":"IN",
            "iso3":"IND",
            "phoneCode":"+91"
        },
        {
            "country":"Indonesia",
            "iso2":"ID",
            "iso3":"IDN",
            "phoneCode":"+62"
        },
        {
            "country":"Irán",
            "iso2":"IR",
            "iso3":"IRN",
            "phoneCode":"+98"
        },
        {
            "country":"Irak",
            "iso2":"IQ",
            "iso3":"IRQ",
            "phoneCode":"+964"
        },
        {
            "country":"Irlanda",
            "iso2":"IE",
            "iso3":"IRL",
            "phoneCode":"+353"
        },
        {
            "country":"Isla Bouvet",
            "iso2":"BV",
            "iso3":"BVT",
            "phoneCode":"+"
        },
        {
            "country":"Isla de Man",
            "iso2":"IM",
            "iso3":"IMN",
            "phoneCode":"+44"
        },
        {
            "country":"Isla de Navidad",
            "iso2":"CX",
            "iso3":"CXR",
            "phoneCode":"+61"
        },
        {
            "country":"Isla Norfolk",
            "iso2":"NF",
            "iso3":"NFK",
            "phoneCode":"+"
        },
        {
            "country":"Islandia",
            "iso2":"IS",
            "iso3":"ISL",
            "phoneCode":"+354"
        },
        {
            "country":"Islas Bermudas",
            "iso2":"BM",
            "iso3":"BMU",
            "phoneCode":"+1 441"
        },
        {
            "country":"Islas Caimán",
            "iso2":"KY",
            "iso3":"CYM",
            "phoneCode":"+1 345"
        },
        {
            "country":"Islas Cocos (Keeling)",
            "iso2":"CC",
            "iso3":"CCK",
            "phoneCode":"+61"
        },
        {
            "country":"Islas Cook",
            "iso2":"CK",
            "iso3":"COK",
            "phoneCode":"+682"
        },
        {
            "country":"Islas de Åland",
            "iso2":"AX",
            "iso3":"ALA",
            "phoneCode":"+"
        },
        {
            "country":"Islas Feroe",
            "iso2":"FO",
            "iso3":"FRO",
            "phoneCode":"+298"
        },
        {
            "country":"Islas Georgias del Sur y Sandwich del Sur",
            "iso2":"GS",
            "iso3":"SGS",
            "phoneCode":"+"
        },
        {
            "country":"Islas Heard y McDonald",
            "iso2":"HM",
            "iso3":"HMD",
            "phoneCode":"+"
        },
        {
            "country":"Islas Maldivas",
            "iso2":"MV",
            "iso3":"MDV",
            "phoneCode":"+960"
        },
        {
            "country":"Islas Malvinas",
            "iso2":"FK",
            "iso3":"FLK",
            "phoneCode":"+500"
        },
        {
            "country":"Islas Marianas del Norte",
            "iso2":"MP",
            "iso3":"MNP",
            "phoneCode":"+1 670"
        },
        {
            "country":"Islas Marshall",
            "iso2":"MH",
            "iso3":"MHL",
            "phoneCode":"+692"
        },
        {
            "country":"Islas Pitcairn",
            "iso2":"PN",
            "iso3":"PCN",
            "phoneCode":"+870"
        },
        {
            "country":"Islas Salomón",
            "iso2":"SB",
            "iso3":"SLB",
            "phoneCode":"+677"
        },
        {
            "country":"Islas Turcas y Caicos",
            "iso2":"TC",
            "iso3":"TCA",
            "phoneCode":"+1 649"
        },
        {
            "country":"Islas Ultramarinas Menores de Estados Unidos",
            "iso2":"UM",
            "iso3":"UMI",
            "phoneCode":"+"
        },
        {
            "country":"Islas Vírgenes Británicas",
            "iso2":"VG",
            "iso3":"VG",
            "phoneCode":"+1 284"
        },
        {
            "country":"Islas Vírgenes de los Estados Unidos",
            "iso2":"VI",
            "iso3":"VIR",
            "phoneCode":"+1 340"
        },
        {
            "country":"Israel",
            "iso2":"IL",
            "iso3":"ISR",
            "phoneCode":"+972"
        },
        {
            "country":"Italia",
            "iso2":"IT",
            "iso3":"ITA",
            "phoneCode":"+39"
        },
        {
            "country":"Jamaica",
            "iso2":"JM",
            "iso3":"JAM",
            "phoneCode":"+1 876"
        },
        {
            "country":"Japón",
            "iso2":"JP",
            "iso3":"JPN",
            "phoneCode":"+81"
        },
        {
            "country":"Jersey",
            "iso2":"JE",
            "iso3":"JEY",
            "phoneCode":"+"
        },
        {
            "country":"Jordania",
            "iso2":"JO",
            "iso3":"JOR",
            "phoneCode":"+962"
        },
        {
            "country":"Kazajistán",
            "iso2":"KZ",
            "iso3":"KAZ",
            "phoneCode":"+7"
        },
        {
            "country":"Kenia",
            "iso2":"KE",
            "iso3":"KEN",
            "phoneCode":"+254"
        },
        {
            "country":"Kirgizstán",
            "iso2":"KG",
            "iso3":"KGZ",
            "phoneCode":"+996"
        },
        {
            "country":"Kiribati",
            "iso2":"KI",
            "iso3":"KIR",
            "phoneCode":"+686"
        },
        {
            "country":"Kuwait",
            "iso2":"KW",
            "iso3":"KWT",
            "phoneCode":"+965"
        },
        {
            "country":"Líbano",
            "iso2":"LB",
            "iso3":"LBN",
            "phoneCode":"+961"
        },
        {
            "country":"Laos",
            "iso2":"LA",
            "iso3":"LAO",
            "phoneCode":"+856"
        },
        {
            "country":"Lesoto",
            "iso2":"LS",
            "iso3":"LSO",
            "phoneCode":"+266"
        },
        {
            "country":"Letonia",
            "iso2":"LV",
            "iso3":"LVA",
            "phoneCode":"+371"
        },
        {
            "country":"Liberia",
            "iso2":"LR",
            "iso3":"LBR",
            "phoneCode":"+231"
        },
        {
            "country":"Libia",
            "iso2":"LY",
            "iso3":"LBY",
            "phoneCode":"+218"
        },
        {
            "country":"Liechtenstein",
            "iso2":"LI",
            "iso3":"LIE",
            "phoneCode":"+423"
        },
        {
            "country":"Lituania",
            "iso2":"LT",
            "iso3":"LTU",
            "phoneCode":"+370"
        },
        {
            "country":"Luxemburgo",
            "iso2":"LU",
            "iso3":"LUX",
            "phoneCode":"+352"
        },
        {
            "country":"México",
            "iso2":"MX",
            "iso3":"MEX",
            "phoneCode":"+52"
        },
        {
            "country":"Mónaco",
            "iso2":"MC",
            "iso3":"MCO",
            "phoneCode":"+377"
        },
        {
            "country":"Macao",
            "iso2":"MO",
            "iso3":"MAC",
            "phoneCode":"+853"
        },
        {
            "country":"Macedônia",
            "iso2":"MK",
            "iso3":"MKD",
            "phoneCode":"+389"
        },
        {
            "country":"Madagascar",
            "iso2":"MG",
            "iso3":"MDG",
            "phoneCode":"+261"
        },
        {
            "country":"Malasia",
            "iso2":"MY",
            "iso3":"MYS",
            "phoneCode":"+60"
        },
        {
            "country":"Malawi",
            "iso2":"MW",
            "iso3":"MWI",
            "phoneCode":"+265"
        },
        {
            "country":"Mali",
            "iso2":"ML",
            "iso3":"MLI",
            "phoneCode":"+223"
        },
        {
            "country":"Malta",
            "iso2":"MT",
            "iso3":"MLT",
            "phoneCode":"+356"
        },
        {
            "country":"Marruecos",
            "iso2":"MA",
            "iso3":"MAR",
            "phoneCode":"+212"
        },
        {
            "country":"Martinica",
            "iso2":"MQ",
            "iso3":"MTQ",
            "phoneCode":"+"
        },
        {
            "country":"Mauricio",
            "iso2":"MU",
            "iso3":"MUS",
            "phoneCode":"+230"
        },
        {
            "country":"Mauritania",
            "iso2":"MR",
            "iso3":"MRT",
            "phoneCode":"+222"
        },
        {
            "country":"Mayotte",
            "iso2":"YT",
            "iso3":"MYT",
            "phoneCode":"+262"
        },
        {
            "country":"Micronesia",
            "iso2":"FM",
            "iso3":"FSM",
            "phoneCode":"+691"
        },
        {
            "country":"Moldavia",
            "iso2":"MD",
            "iso3":"MDA",
            "phoneCode":"+373"
        },
        {
            "country":"Mongolia",
            "iso2":"MN",
            "iso3":"MNG",
            "phoneCode":"+976"
        },
        {
            "country":"Montenegro",
            "iso2":"ME",
            "iso3":"MNE",
            "phoneCode":"+382"
        },
        {
            "country":"Montserrat",
            "iso2":"MS",
            "iso3":"MSR",
            "phoneCode":"+1 664"
        },
        {
            "country":"Mozambique",
            "iso2":"MZ",
            "iso3":"MOZ",
            "phoneCode":"+258"
        },
        {
            "country":"Namibia",
            "iso2":"NA",
            "iso3":"NAM",
            "phoneCode":"+264"
        },
        {
            "country":"Nauru",
            "iso2":"NR",
            "iso3":"NRU",
            "phoneCode":"+674"
        },
        {
            "country":"Nepal",
            "iso2":"NP",
            "iso3":"NPL",
            "phoneCode":"+977"
        },
        {
            "country":"Nicaragua",
            "iso2":"NI",
            "iso3":"NIC",
            "phoneCode":"+505"
        },
        {
            "country":"Niger",
            "iso2":"NE",
            "iso3":"NER",
            "phoneCode":"+227"
        },
        {
            "country":"Nigeria",
            "iso2":"NG",
            "iso3":"NGA",
            "phoneCode":"+234"
        },
        {
            "country":"Niue",
            "iso2":"NU",
            "iso3":"NIU",
            "phoneCode":"+683"
        },
        {
            "country":"Noruega",
            "iso2":"NO",
            "iso3":"NOR",
            "phoneCode":"+47"
        },
        {
            "country":"Nueva Caledonia",
            "iso2":"NC",
            "iso3":"NCL",
            "phoneCode":"+687"
        },
        {
            "country":"Nueva Zelanda",
            "iso2":"NZ",
            "iso3":"NZL",
            "phoneCode":"+64"
        },
        {
            "country":"Omán",
            "iso2":"OM",
            "iso3":"OMN",
            "phoneCode":"+968"
        },
        {
            "country":"Países Bajos",
            "iso2":"NL",
            "iso3":"NLD",
            "phoneCode":"+31"
        },
        {
            "country":"Pakistán",
            "iso2":"PK",
            "iso3":"PAK",
            "phoneCode":"+92"
        },
        {
            "country":"Palau",
            "iso2":"PW",
            "iso3":"PLW",
            "phoneCode":"+680"
        },
        {
            "country":"Palestina",
            "iso2":"PS",
            "iso3":"PSE",
            "phoneCode":"+"
        },
        {
            "country":"Panamá",
            "iso2":"PA",
            "iso3":"PAN",
            "phoneCode":"+507"
        },
        {
            "country":"Papúa Nueva Guinea",
            "iso2":"PG",
            "iso3":"PNG",
            "phoneCode":"+675"
        },
        {
            "country":"Paraguay",
            "iso2":"PY",
            "iso3":"PRY",
            "phoneCode":"+595"
        },
        {
            "country":"Perú",
            "iso2":"PE",
            "iso3":"PER",
            "phoneCode":"+51"
        },
        {
            "country":"Polinesia Francesa",
            "iso2":"PF",
            "iso3":"PYF",
            "phoneCode":"+689"
        },
        {
            "country":"Polonia",
            "iso2":"PL",
            "iso3":"POL",
            "phoneCode":"+48"
        },
        {
            "country":"Portugal",
            "iso2":"PT",
            "iso3":"PRT",
            "phoneCode":"+351"
        },
        {
            "country":"Puerto Rico",
            "iso2":"PR",
            "iso3":"PRI",
            "phoneCode":"+1"
        },
        {
            "country":"Qatar",
            "iso2":"QA",
            "iso3":"QAT",
            "phoneCode":"+974"
        },
        {
            "country":"Reino Unido",
            "iso2":"GB",
            "iso3":"GBR",
            "phoneCode":"+44"
        },
        {
            "country":"República Centroafricana",
            "iso2":"CF",
            "iso3":"CAF",
            "phoneCode":"+236"
        },
        {
            "country":"República Checa",
            "iso2":"CZ",
            "iso3":"CZE",
            "phoneCode":"+420"
        },
        {
            "country":"República Dominicana",
            "iso2":"DO",
            "iso3":"DOM",
            "phoneCode":"+1 809"
        },
        {
            "country":"Reunión",
            "iso2":"RE",
            "iso3":"REU",
            "phoneCode":"+"
        },
        {
            "country":"Ruanda",
            "iso2":"RW",
            "iso3":"RWA",
            "phoneCode":"+250"
        },
        {
            "country":"Rumanía",
            "iso2":"RO",
            "iso3":"ROU",
            "phoneCode":"+40"
        },
        {
            "country":"Rusia",
            "iso2":"RU",
            "iso3":"RUS",
            "phoneCode":"+7"
        },
        {
            "country":"Sahara Occidental",
            "iso2":"EH",
            "iso3":"ESH",
            "phoneCode":"+"
        },
        {
            "country":"Samoa",
            "iso2":"WS",
            "iso3":"WSM",
            "phoneCode":"+685"
        },
        {
            "country":"Samoa Americana",
            "iso2":"AS",
            "iso3":"ASM",
            "phoneCode":"+1 684"
        },
        {
            "country":"San Bartolomé",
            "iso2":"BL",
            "iso3":"BLM",
            "phoneCode":"+590"
        },
        {
            "country":"San Cristóbal y Nieves",
            "iso2":"KN",
            "iso3":"KNA",
            "phoneCode":"+1 869"
        },
        {
            "country":"San Marino",
            "iso2":"SM",
            "iso3":"SMR",
            "phoneCode":"+378"
        },
        {
            "country":"San Martín (Francia)",
            "iso2":"MF",
            "iso3":"MAF",
            "phoneCode":"+1 599"
        },
        {
            "country":"San Pedro y Miquelón",
            "iso2":"PM",
            "iso3":"SPM",
            "phoneCode":"+508"
        },
        {
            "country":"San Vicente y las Granadinas",
            "iso2":"VC",
            "iso3":"VCT",
            "phoneCode":"+1 784"
        },
        {
            "country":"Santa Elena",
            "iso2":"SH",
            "iso3":"SHN",
            "phoneCode":"+290"
        },
        {
            "country":"Santa Lucía",
            "iso2":"LC",
            "iso3":"LCA",
            "phoneCode":"+1 758"
        },
        {
            "country":"Santo Tomé y Príncipe",
            "iso2":"ST",
            "iso3":"STP",
            "phoneCode":"+239"
        },
        {
            "country":"Senegal",
            "iso2":"SN",
            "iso3":"SEN",
            "phoneCode":"+221"
        },
        {
            "country":"Serbia",
            "iso2":"RS",
            "iso3":"SRB",
            "phoneCode":"+381"
        },
        {
            "country":"Seychelles",
            "iso2":"SC",
            "iso3":"SYC",
            "phoneCode":"+248"
        },
        {
            "country":"Sierra Leona",
            "iso2":"SL",
            "iso3":"SLE",
            "phoneCode":"+232"
        },
        {
            "country":"Singapur",
            "iso2":"SG",
            "iso3":"SGP",
            "phoneCode":"+65"
        },
        {
            "country":"Siria",
            "iso2":"SY",
            "iso3":"SYR",
            "phoneCode":"+963"
        },
        {
            "country":"Somalia",
            "iso2":"SO",
            "iso3":"SOM",
            "phoneCode":"+252"
        },
        {
            "country":"Sri lanka",
            "iso2":"LK",
            "iso3":"LKA",
            "phoneCode":"+94"
        },
        {
            "country":"Sudáfrica",
            "iso2":"ZA",
            "iso3":"ZAF",
            "phoneCode":"+27"
        },
        {
            "country":"Sudán",
            "iso2":"SD",
            "iso3":"SDN",
            "phoneCode":"+249"
        },
        {
            "country":"Suecia",
            "iso2":"SE",
            "iso3":"SWE",
            "phoneCode":"+46"
        },
        {
            "country":"Suiza",
            "iso2":"CH",
            "iso3":"CHE",
            "phoneCode":"+41"
        },
        {
            "country":"Surinám",
            "iso2":"SR",
            "iso3":"SUR",
            "phoneCode":"+597"
        },
        {
            "country":"Svalbard y Jan Mayen",
            "iso2":"SJ",
            "iso3":"SJM",
            "phoneCode":"+"
        },
        {
            "country":"Swazilandia",
            "iso2":"SZ",
            "iso3":"SWZ",
            "phoneCode":"+268"
        },
        {
            "country":"Tadjikistán",
            "iso2":"TJ",
            "iso3":"TJK",
            "phoneCode":"+992"
        },
        {
            "country":"Tailandia",
            "iso2":"TH",
            "iso3":"THA",
            "phoneCode":"+66"
        },
        {
            "country":"Taiwán",
            "iso2":"TW",
            "iso3":"TWN",
            "phoneCode":"+886"
        },
        {
            "country":"Tanzania",
            "iso2":"TZ",
            "iso3":"TZA",
            "phoneCode":"+255"
        },
        {
            "country":"Territorio Británico del Océano Índico",
            "iso2":"IO",
            "iso3":"IOT",
            "phoneCode":"+"
        },
        {
            "country":"Territorios Australes y Antárticas Franceses",
            "iso2":"TF",
            "iso3":"ATF",
            "phoneCode":"+"
        },
        {
            "country":"Timor Oriental",
            "iso2":"TL",
            "iso3":"TLS",
            "phoneCode":"+670"
        },
        {
            "country":"Togo",
            "iso2":"TG",
            "iso3":"TGO",
            "phoneCode":"+228"
        },
        {
            "country":"Tokelau",
            "iso2":"TK",
            "iso3":"TKL",
            "phoneCode":"+690"
        },
        {
            "country":"Tonga",
            "iso2":"TO",
            "iso3":"TON",
            "phoneCode":"+676"
        },
        {
            "country":"Trinidad y Tobago",
            "iso2":"TT",
            "iso3":"TTO",
            "phoneCode":"+1 868"
        },
        {
            "country":"Tunez",
            "iso2":"TN",
            "iso3":"TUN",
            "phoneCode":"+216"
        },
        {
            "country":"Turkmenistán",
            "iso2":"TM",
            "iso3":"TKM",
            "phoneCode":"+993"
        },
        {
            "country":"Turquía",
            "iso2":"TR",
            "iso3":"TUR",
            "phoneCode":"+90"
        },
        {
            "country":"Tuvalu",
            "iso2":"TV",
            "iso3":"TUV",
            "phoneCode":"+688"
        },
        {
            "country":"Ucrania",
            "iso2":"UA",
            "iso3":"UKR",
            "phoneCode":"+380"
        },
        {
            "country":"Uganda",
            "iso2":"UG",
            "iso3":"UGA",
            "phoneCode":"+256"
        },
        {
            "country":"Uruguay",
            "iso2":"UY",
            "iso3":"URY",
            "phoneCode":"+598"
        },
        {
            "country":"Uzbekistán",
            "iso2":"UZ",
            "iso3":"UZB",
            "phoneCode":"+998"
        },
        {
            "country":"Vanuatu",
            "iso2":"VU",
            "iso3":"VUT",
            "phoneCode":"+678"
        },
        {
            "country":"Venezuela",
            "iso2":"VE",
            "iso3":"VEN",
            "phoneCode":"+58"
        },
        {
            "country":"Vietnam",
            "iso2":"VN",
            "iso3":"VNM",
            "phoneCode":"+84"
        },
        {
            "country":"Wallis y Futuna",
            "iso2":"WF",
            "iso3":"WLF",
            "phoneCode":"+681"
        },
        {
            "country":"Yemen",
            "iso2":"YE",
            "iso3":"YEM",
            "phoneCode":"+967"
        },
        {
            "country":"Yibuti",
            "iso2":"DJ",
            "iso3":"DJI",
            "phoneCode":"+253"
        },
        {
            "country":"Zambia",
            "iso2":"ZM",
            "iso3":"ZMB",
            "phoneCode":"+260"
        },
        {
            "country":"Zimbabue",
            "iso2":"ZW",
            "iso3":"ZWE",
            "phoneCode":"+263"
        }
      ]', true);

        foreach ($data as $country) {
            $newCountry = new \App\Country();
            $newCountry->name = $country['country'];
            $newCountry->iso2 = $country['iso2'];
            $newCountry->iso3 = $country['iso3'];
            $newCountry->phone_code = $country['phoneCode'];
            $newCountry->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
