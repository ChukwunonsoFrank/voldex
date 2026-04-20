<?php

namespace App\Livewire\Dashboard;

use App\Models\Kyc as ModelsKyc;
use App\Notifications\KYCInitiated;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Livewire\WithFileUploads;

class Kyc extends Component
{
  use WithFileUploads;

  public string $fullname;

  public string $dob;

  public string $selectedCountry = "";

  public $id;

  public array $countriesList = [
    "AF" => "Afghanistan",
    "AL" => "Albania",
    "DZ" => "Algeria",
    "AD" => "Andorra",
    "AO" => "Angola",
    "AG" => "Antigua and Barbuda",
    "AR" => "Argentina",
    "AM" => "Armenia",
    "AU" => "Australia",
    "AT" => "Austria",
    "AZ" => "Azerbaijan",
    "BS" => "Bahamas",
    "BH" => "Bahrain",
    "BD" => "Bangladesh",
    "BB" => "Barbados",
    "BY" => "Belarus",
    "BE" => "Belgium",
    "BZ" => "Belize",
    "BJ" => "Benin",
    "BT" => "Bhutan",
    "BO" => "Bolivia",
    "BA" => "Bosnia and Herzegovina",
    "BW" => "Botswana",
    "BR" => "Brazil",
    "BN" => "Brunei",
    "BG" => "Bulgaria",
    "BF" => "Burkina Faso",
    "BI" => "Burundi",
    "CV" => "Cabo Verde",
    "KH" => "Cambodia",
    "CM" => "Cameroon",
    "CA" => "Canada",
    "CF" => "Central African Republic",
    "TD" => "Chad",
    "CL" => "Chile",
    "CN" => "China",
    "CO" => "Colombia",
    "KM" => "Comoros",
    "CD" => "Congo (Democratic Republic of the)",
    "CG" => "Congo (Republic of the)",
    "CR" => "Costa Rica",
    "CI" => 'Côte d\'Ivoire',
    "HR" => "Croatia",
    "CU" => "Cuba",
    "CY" => "Cyprus",
    "CZ" => "Czechia",
    "DK" => "Denmark",
    "DJ" => "Djibouti",
    "DM" => "Dominica",
    "DO" => "Dominican Republic",
    "EC" => "Ecuador",
    "EG" => "Egypt",
    "SV" => "El Salvador",
    "GQ" => "Equatorial Guinea",
    "ER" => "Eritrea",
    "EE" => "Estonia",
    "SZ" => "Eswatini",
    "ET" => "Ethiopia",
    "FJ" => "Fiji",
    "FI" => "Finland",
    "FR" => "France",
    "GA" => "Gabon",
    "GM" => "Gambia",
    "GE" => "Georgia",
    "DE" => "Germany",
    "GH" => "Ghana",
    "GR" => "Greece",
    "GD" => "Grenada",
    "GT" => "Guatemala",
    "GN" => "Guinea",
    "GW" => "Guinea-Bissau",
    "GY" => "Guyana",
    "HT" => "Haiti",
    "VA" => "Holy See",
    "HN" => "Honduras",
    "HU" => "Hungary",
    "IS" => "Iceland",
    "IN" => "India",
    "ID" => "Indonesia",
    "IR" => "Iran",
    "IQ" => "Iraq",
    "IE" => "Ireland",
    "IL" => "Israel",
    "IT" => "Italy",
    "JM" => "Jamaica",
    "JP" => "Japan",
    "JO" => "Jordan",
    "KZ" => "Kazakhstan",
    "KE" => "Kenya",
    "KI" => "Kiribati",
    "KW" => "Kuwait",
    "KG" => "Kyrgyzstan",
    "LA" => "Laos",
    "LV" => "Latvia",
    "LB" => "Lebanon",
    "LS" => "Lesotho",
    "LR" => "Liberia",
    "LY" => "Libya",
    "LI" => "Liechtenstein",
    "LT" => "Lithuania",
    "LU" => "Luxembourg",
    "MG" => "Madagascar",
    "MW" => "Malawi",
    "MY" => "Malaysia",
    "MV" => "Maldives",
    "ML" => "Mali",
    "MT" => "Malta",
    "MH" => "Marshall Islands",
    "MR" => "Mauritania",
    "MU" => "Mauritius",
    "MX" => "Mexico",
    "FM" => "Micronesia",
    "MD" => "Moldova",
    "MC" => "Monaco",
    "MN" => "Mongolia",
    "ME" => "Montenegro",
    "MA" => "Morocco",
    "MZ" => "Mozambique",
    "MM" => "Myanmar",
    "NA" => "Namibia",
    "NR" => "Nauru",
    "NP" => "Nepal",
    "NL" => "Netherlands",
    "NZ" => "New Zealand",
    "NI" => "Nicaragua",
    "NE" => "Niger",
    "NG" => "Nigeria",
    "KP" => "North Korea",
    "MK" => "North Macedonia",
    "NO" => "Norway",
    "OM" => "Oman",
    "PK" => "Pakistan",
    "PW" => "Palau",
    "PA" => "Panama",
    "PG" => "Papua New Guinea",
    "PY" => "Paraguay",
    "PE" => "Peru",
    "PH" => "Philippines",
    "PL" => "Poland",
    "PT" => "Portugal",
    "QA" => "Qatar",
    "RO" => "Romania",
    "RU" => "Russia",
    "RW" => "Rwanda",
    "KN" => "Saint Kitts and Nevis",
    "LC" => "Saint Lucia",
    "VC" => "Saint Vincent and the Grenadines",
    "WS" => "Samoa",
    "SM" => "San Marino",
    "ST" => "Sao Tome and Principe",
    "SA" => "Saudi Arabia",
    "SN" => "Senegal",
    "RS" => "Serbia",
    "SC" => "Seychelles",
    "SL" => "Sierra Leone",
    "SG" => "Singapore",
    "SK" => "Slovakia",
    "SI" => "Slovenia",
    "SB" => "Solomon Islands",
    "SO" => "Somalia",
    "ZA" => "South Africa",
    "KR" => "South Korea",
    "SS" => "South Sudan",
    "ES" => "Spain",
    "LK" => "Sri Lanka",
    "SD" => "Sudan",
    "SR" => "Suriname",
    "SE" => "Sweden",
    "CH" => "Switzerland",
    "SY" => "Syria",
    "TW" => "Taiwan",
    "TJ" => "Tajikistan",
    "TZ" => "Tanzania",
    "TH" => "Thailand",
    "TL" => "Timor-Leste",
    "TG" => "Togo",
    "TO" => "Tonga",
    "TT" => "Trinidad and Tobago",
    "TN" => "Tunisia",
    "TR" => "Turkey",
    "TM" => "Turkmenistan",
    "TV" => "Tuvalu",
    "UG" => "Uganda",
    "UA" => "Ukraine",
    "AE" => "United Arab Emirates",
    "GB" => "United Kingdom",
    "US" => "United States",
    "UY" => "Uruguay",
    "UZ" => "Uzbekistan",
    "VU" => "Vanuatu",
    "VE" => "Venezuela",
    "VN" => "Vietnam",
    "YE" => "Yemen",
    "ZM" => "Zambia",
    "ZW" => "Zimbabwe",
    "PS" => "Palestine",
  ];

  public string $kycStatus = "";

  public bool $isKycPending = false;

  protected $rules = [
    "fullname" => "required|string|min:2|max:255",
    "selectedCountry" => "required|string",
    "id" => "required|file|mimes:jpeg,jpg,png|max:5120",
  ];

  protected $messages = [
    "fullname.required" => "Full name is required.",
    "fullname.min" => "Full name must be at least 2 characters.",
    "fullname.max" => "Full name cannot exceed 255 characters.",
    "selectedCountry.required" => "Please select a country.",
    "id.required" => "Please upload your ID document.",
    "id.file" => "The uploaded file is not valid.",
    "id.mimes" => "ID document must be a JPEG, JPG or PNG file.",
    "id.max" => "ID document size cannot exceed 5MB.",
  ];

  public function updated($propertyName)
  {
    try {
      $this->validateOnly($propertyName);
    } catch (\Illuminate\Validation\ValidationException $e) {
      $errors = $e->validator->errors()->all();
      $this->dispatch(
        "error-message",
        message: implode(" ", $errors),
      )->self();
    }
  }

  public function selectCountry($country)
  {
    $this->selectedCountry = $country;
  }

  public function submitKYCApplication()
  {
    try {
      $this->validate();
    } catch (\Illuminate\Validation\ValidationException $e) {
      $errors = $e->validator->errors()->all();
      $this->dispatch(
        "error-message",
        message: implode(" ", $errors),
      )->self();
      return;
    }

    try {
      $pendingKyc = ModelsKyc::where(
        "user_id",
        "=",
        auth()->user()->id,
        "and",
      )
        ->where("status", "=", "pending", "and")
        ->first();

      if ($pendingKyc) {
        $this->dispatch(
          "error-message",
          message: "You have an ongoing KYC request verification and cannot submit another.",
        )->self();
        return;
      }

      ModelsKyc::create([
        "user_id" => auth()->user()->id,
        "fullname" => $this->fullname,
        "dob" => $this->dob,
        "country" => $this->selectedCountry,
        "id_image_path" => "kyc/" . $this->id->getClientOriginalName(),
        "status" => "pending",
      ]);

      $this->id->storeAs(
        path: "kyc",
        name: $this->id->getClientOriginalName(),
      );

      $this->dispatch("success-message")->self();

      Notification::route("mail", "fredbest230@gmail.com")->notify(
        new KYCInitiated(auth()->user()->name),
      );

      // Reset form fields
      $this->selectedCountry = "";
      $this->reset();
    } catch (\Exception $e) {
      $this->dispatch("error-message", message: $e->getMessage())->self();
    }
  }

  public function robot()
  {
    $this->redirectRoute("dashboard.robot");
  }

  public function render()
  {
    $this->kycStatus = auth()->user()->is_kyc_verified
      ? "Verified"
      : "Not verified";
    $kycRequest = ModelsKyc::where(
      "user_id",
      "=",
      auth()->user()->id,
      "and",
    )
      ->latest()
      ->first();

    if ($kycRequest && $kycRequest["status"] === "pending") {
      $this->isKycPending = true;
    }
    return view("livewire.dashboard.kyc");
  }
}
