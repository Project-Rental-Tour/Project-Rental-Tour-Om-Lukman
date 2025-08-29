@extends('_layouts.user')

@section('head')
@endsection

@section('content')
    @include('components.client.navbar')
    <section class="bg-primary text-white py-20" id="jumbotron">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Design Your Dream Trip</h1>
            <p class="text-xl md:text-2xl text-indigo-100 max-w-3xl mx-auto leading-relaxed">
                No package fits your dream? <br>
                Tell us your ideal destination, dates, and preferences —
                we’ll create a personalized travel experience just for you.
            </p>
        </div>
    </section>



    <!-- Custom Booking Form -->
    <section class="container mx-auto px-6 py-16">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gray-50 px-8 py-6 border-b">
                <h2 class="text-2xl font-bold text-gray-800">Your Travel Preferences</h2>
                <p class="text-gray-600 mt-1">Fill in the details below. We’ll get back within 24 hours with a quote.</p>
            </div>

            <!-- Form -->
            <form action="{{ route('booking.custom.store') }}" method="POST" class="p-8 space-y-8">
                @csrf

                <!-- Desired Destinations -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Destinations You Want to Visit <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="custom_destinations" placeholder="e.g. Bali, Komodo, Lombok, Yogyakarta"
                        class="w-full p-3 border border-gray-300 rounded-lg  focus:border-blue-500" required>
                    <p class="text-xs text-gray-500 mt-1">Separate with commas if multiple.</p>
                </div>

                <!-- Travel Date & Duration -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Preferred Travel Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="travel_date" required
                            class="w-full p-3 border border-gray-300 rounded-lg  focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Duration (Nights) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="duration_nights" min="1" max="60" placeholder="e.g. 5"
                            class="w-full p-3 border border-gray-300 rounded-lg  focus:border-blue-500" required>
                    </div>
                </div>

                <!-- Travelers -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Number of Travelers <span class="text-red-500">*</span>
                    </label>
                    <select name="travelers" required class="w-full p-3 border border-gray-300 rounded-lg bg-white ">
                        <option value="">Select number</option>
                        <option value="1">1 person</option>
                        <option value="2">2 people</option>
                        <option value="3">3 people</option>
                        <option value="4">4 people</option>
                        <option value="5">5 people</option>
                        <option value="6+">6 or more</option>
                    </select>
                </div>

                <!-- Budget Range -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Budget Range (per person)</label>
                    <select name="budget_range" class="w-full p-3 border border-gray-300 rounded-lg bg-white ">
                        <option value="">No preference</option>
                        <option value="Below Rp 3 juta">Below Rp 3 juta</option>
                        <option value="Rp 3 - 5 juta">Rp 3 - 5 juta</option>
                        <option value="Rp 5 - 8 juta">Rp 5 - 8 juta</option>
                        <option value="Rp 8 - 12 juta">Rp 8 - 12 juta</option>
                        <option value="Above Rp 12 juta">Above Rp 12 juta</option>
                    </select>
                </div>

                <!-- Interests / Activities -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        What Interests You? (Optional)
                    </label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @foreach(['Adventure', 'Relaxation', 'Cultural', 'Honeymoon', 'Family', 'Photography', 'Food & Culinary', 'Trekking', 'Beach'] as $interest)
                            <label class="checkbox-group">
                                <input type="checkbox" name="interests[]" value="{{ $interest }}">
                                <span>{{ $interest }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Personal Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            First Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="first_name" placeholder="John"
                            class="w-full p-3 border border-gray-300 rounded-lg " required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Last Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="last_name" placeholder="Doe"
                            class="w-full p-3 border border-gray-300 rounded-lg " required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" placeholder="you@example.com"
                            class="w-full p-3 border border-gray-300 rounded-lg " required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Phone Number <span class="text-red-500">*</span>
                        </label>

                        <div class="flex gap-2">
                            <!-- Country Code Dropdown -->
                            <select name="country_code" id="country_code"
                                class="w-1/4 p-3 border border-gray-300 rounded-lg " required>
                                <option value="">Country Code</option>
                                <option value="+93">+93 (AF) – Afghanistan</option>
                                <option value="+355">+355 (AL) – Albania</option>
                                <option value="+213">+213 (DZ) – Algeria</option>
                                <option value="+1-684">+1-684 (AS) – American Samoa</option>
                                <option value="+376">+376 (AD) – Andorra</option>
                                <option value="+244">+244 (AO) – Angola</option>
                                <option value="+1-264">+1-264 (AI) – Anguilla</option>
                                <option value="+1-268">+1-268 (AG) – Antigua and Barbuda</option>
                                <option value="+54">+54 (AR) – Argentina</option>
                                <option value="+374">+374 (AM) – Armenia</option>
                                <option value="+297">+297 (AW) – Aruba</option>
                                <option value="+61">+61 (AU) – Australia</option>
                                <option value="+43">+43 (AT) – Austria</option>
                                <option value="+994">+994 (AZ) – Azerbaijan</option>
                                <option value="+1-242">+1-242 (BS) – Bahamas</option>
                                <option value="+973">+973 (BH) – Bahrain</option>
                                <option value="+880">+880 (BD) – Bangladesh</option>
                                <option value="+1-246">+1-246 (BB) – Barbados</option>
                                <option value="+375">+375 (BY) – Belarus</option>
                                <option value="+32">+32 (BE) – Belgium</option>
                                <option value="+501">+501 (BZ) – Belize</option>
                                <option value="+229">+229 (BJ) – Benin</option>
                                <option value="+1-441">+1-441 (BM) – Bermuda</option>
                                <option value="+975">+975 (BT) – Bhutan</option>
                                <option value="+591">+591 (BO) – Bolivia</option>
                                <option value="+387">+387 (BA) – Bosnia and Herzegovina</option>
                                <option value="+267">+267 (BW) – Botswana</option>
                                <option value="+55">+55 (BR) – Brazil</option>
                                <option value="+246">+246 (IO) – British Indian Ocean Territory</option>
                                <option value="+1-284">+1-284 (VG) – British Virgin Islands</option>
                                <option value="+673">+673 (BN) – Brunei</option>
                                <option value="+359">+359 (BG) – Bulgaria</option>
                                <option value="+226">+226 (BF) – Burkina Faso</option>
                                <option value="+257">+257 (BI) – Burundi</option>
                                <option value="+855">+855 (KH) – Cambodia</option>
                                <option value="+237">+237 (CM) – Cameroon</option>
                                <option value="+1">+1 (CA) – Canada</option>
                                <option value="+238">+238 (CV) – Cape Verde</option>
                                <option value="+1-345">+1-345 (KY) – Cayman Islands</option>
                                <option value="+236">+236 (CF) – Central African Republic</option>
                                <option value="+235">+235 (TD) – Chad</option>
                                <option value="+56">+56 (CL) – Chile</option>
                                <option value="+86">+86 (CN) – China</option>
                                <option value="+57">+57 (CO) – Colombia</option>
                                <option value="+269">+269 (KM) – Comoros</option>
                                <option value="+682">+682 (CK) – Cook Islands</option>
                                <option value="+506">+506 (CR) – Costa Rica</option>
                                <option value="+385">+385 (HR) – Croatia</option>
                                <option value="+53">+53 (CU) – Cuba</option>
                                <option value="+599">+599 (CW) – Curaçao</option>
                                <option value="+357">+357 (CY) – Cyprus</option>
                                <option value="+420">+420 (CZ) – Czech Republic</option>
                                <option value="+243">+243 (CD) – DR Congo</option>
                                <option value="+45">+45 (DK) – Denmark</option>
                                <option value="+253">+253 (DJ) – Djibouti</option>
                                <option value="+1-767">+1-767 (DM) – Dominica</option>
                                <option value="+1-809">+1-809 / +1-829 / +1-849 (DO) – Dominican Republic</option>
                                <option value="+593">+593 (EC) – Ecuador</option>
                                <option value="+20">+20 (EG) – Egypt</option>
                                <option value="+503">+503 (SV) – El Salvador</option>
                                <option value="+240">+240 (GQ) – Equatorial Guinea</option>
                                <option value="+291">+291 (ER) – Eritrea</option>
                                <option value="+372">+372 (EE) – Estonia</option>
                                <option value="+251">+251 (ET) – Ethiopia</option>
                                <option value="+500">+500 (FK) – Falkland Islands</option>
                                <option value="+298">+298 (FO) – Faroe Islands</option>
                                <option value="+679">+679 (FJ) – Fiji</option>
                                <option value="+358">+358 (FI) – Finland</option>
                                <option value="+33">+33 (FR) – France</option>
                                <option value="+689">+689 (PF) – French Polynesia</option>
                                <option value="+241">+241 (GA) – Gabon</option>
                                <option value="+220">+220 (GM) – Gambia</option>
                                <option value="+995">+995 (GE) – Georgia</option>
                                <option value="+49">+49 (DE) – Germany</option>
                                <option value="+233">+233 (GH) – Ghana</option>
                                <option value="+350">+350 (GI) – Gibraltar</option>
                                <option value="+30">+30 (GR) – Greece</option>
                                <option value="+299">+299 (GL) – Greenland</option>
                                <option value="+1-473">+1-473 (GD) – Grenada</option>
                                <option value="+1-671">+1-671 (GU) – Guam</option>
                                <option value="+502">+502 (GT) – Guatemala</option>
                                <option value="+44-1481">+44-1481 (GG) – Guernsey</option>
                                <option value="+224">+224 (GN) – Guinea</option>
                                <option value="+245">+245 (GW) – Guinea-Bissau</option>
                                <option value="+592">+592 (GY) – Guyana</option>
                                <option value="+509">+509 (HT) – Haiti</option>
                                <option value="+504">+504 (HN) – Honduras</option>
                                <option value="+852">+852 (HK) – Hong Kong</option>
                                <option value="+36">+36 (HU) – Hungary</option>
                                <option value="+354">+354 (IS) – Iceland</option>
                                <option value="+91">+91 (IN) – India</option>
                                <option value="+62">+62 (ID) – Indonesia</option>
                                <option value="+98">+98 (IR) – Iran</option>
                                <option value="+964">+964 (IQ) – Iraq</option>
                                <option value="+353">+353 (IE) – Ireland</option>
                                <option value="+44-1624">+44-1624 (IM) – Isle of Man</option>
                                <option value="+972">+972 (IL) – Israel</option>
                                <option value="+39">+39 (IT) – Italy</option>
                                <option value="+225">+225 (CI) – Ivory Coast</option>
                                <option value="+1-876">+1-876 / +1-658 (JM) – Jamaica</option>
                                <option value="+81">+81 (JP) – Japan</option>
                                <option value="+44-1534">+44-1534 (JE) – Jersey</option>
                                <option value="+962">+962 (JO) – Jordan</option>
                                <option value="+7">+7 (KZ) – Kazakhstan</option>
                                <option value="+254">+254 (KE) – Kenya</option>
                                <option value="+686">+686 (KI) – Kiribati</option>
                                <option value="+383">+383 (XK) – Kosovo</option>
                                <option value="+965">+965 (KW) – Kuwait</option>
                                <option value="+996">+996 (KG) – Kyrgyzstan</option>
                                <option value="+856">+856 (LA) – Laos</option>
                                <option value="+371">+371 (LV) – Latvia</option>
                                <option value="+961">+961 (LB) – Lebanon</option>
                                <option value="+266">+266 (LS) – Lesotho</option>
                                <option value="+231">+231 (LR) – Liberia</option>
                                <option value="+218">+218 (LY) – Libya</option>
                                <option value="+423">+423 (LI) – Liechtenstein</option>
                                <option value="+370">+370 (LT) – Lithuania</option>
                                <option value="+352">+352 (LU) – Luxembourg</option>
                                <option value="+853">+853 (MO) – Macao</option>
                                <option value="+389">+389 (MK) – North Macedonia</option>
                                <option value="+261">+261 (MG) – Madagascar</option>
                                <option value="+265">+265 (MW) – Malawi</option>
                                <option value="+60">+60 (MY) – Malaysia</option>
                                <option value="+960">+960 (MV) – Maldives</option>
                                <option value="+223">+223 (ML) – Mali</option>
                                <option value="+356">+356 (MT) – Malta</option>
                                <option value="+692">+692 (MH) – Marshall Islands</option>
                                <option value="+222">+222 (MR) – Mauritania</option>
                                <option value="+230">+230 (MU) – Mauritius</option>
                                <option value="+52">+52 (MX) – Mexico</option>
                                <option value="+691">+691 (FM) – Micronesia</option>
                                <option value="+373">+373 (MD) – Moldova</option>
                                <option value="+377">+377 (MC) – Monaco</option>
                                <option value="+976">+976 (MN) – Mongolia</option>
                                <option value="+382">+382 (ME) – Montenegro</option>
                                <option value="+1-664">+1-664 (MS) – Montserrat</option>
                                <option value="+212">+212 (MA) – Morocco</option>
                                <option value="+258">+258 (MZ) – Mozambique</option>
                                <option value="+95">+95 (MM) – Myanmar</option>
                                <option value="+264">+264 (NA) – Namibia</option>
                                <option value="+674">+674 (NR) – Nauru</option>
                                <option value="+977">+977 (NP) – Nepal</option>
                                <option value="+31">+31 (NL) – Netherlands</option>
                                <option value="+1-869">+1-869 (KN) – Saint Kitts and Nevis</option>
                                <option value="+687">+687 (NC) – New Caledonia</option>
                                <option value="+64">+64 (NZ) – New Zealand</option>
                                <option value="+505">+505 (NI) – Nicaragua</option>
                                <option value="+227">+227 (NE) – Niger</option>
                                <option value="+234">+234 (NG) – Nigeria</option>
                                <option value="+850">+850 (KP) – North Korea</option>
                                <option value="+47">+47 (NO) – Norway</option>
                                <option value="+968">+968 (OM) – Oman</option>
                                <option value="+92">+92 (PK) – Pakistan</option>
                                <option value="+680">+680 (PW) – Palau</option>
                                <option value="+970">+970 (PS) – Palestine</option>
                                <option value="+507">+507 (PA) – Panama</option>
                                <option value="+675">+675 (PG) – Papua New Guinea</option>
                                <option value="+595">+595 (PY) – Paraguay</option>
                                <option value="+51">+51 (PE) – Peru</option>
                                <option value="+63">+63 (PH) – Philippines</option>
                                <option value="+48">+48 (PL) – Poland</option>
                                <option value="+351">+351 (PT) – Portugal</option>
                                <option value="+1-787">+1-787 / +1-939 (PR) – Puerto Rico</option>
                                <option value="+974">+974 (QA) – Qatar</option>
                                <option value="+242">+242 (CG) – Republic of the Congo</option>
                                <option value="+40">+40 (RO) – Romania</option>
                                <option value="+7">+7 (RU) – Russia</option>
                                <option value="+250">+250 (RW) – Rwanda</option>
                                <option value="+290">+290 (SH) – Saint Helena</option>
                                <option value="+1-869">+1-869 (KN) – Saint Kitts and Nevis</option>
                                <option value="+1-758">+1-758 (LC) – Saint Lucia</option>
                                <option value="+508">+508 (PM) – Saint Pierre and Miquelon</option>
                                <option value="+1-784">+1-784 (VC) – Saint Vincent and the Grenadines</option>
                                <option value="+685">+685 (WS) – Samoa</option>
                                <option value="+378">+378 (SM) – San Marino</option>
                                <option value="+239">+239 (ST) – São Tomé and Príncipe</option>
                                <option value="+966">+966 (SA) – Saudi Arabia</option>
                                <option value="+221">+221 (SN) – Senegal</option>
                                <option value="+381">+381 (RS) – Serbia</option>
                                <option value="+248">+248 (SC) – Seychelles</option>
                                <option value="+232">+232 (SL) – Sierra Leone</option>
                                <option value="+65">+65 (SG) – Singapore</option>
                                <option value="+1-721">+1-721 (SX) – Sint Maarten</option>
                                <option value="+421">+421 (SK) – Slovakia</option>
                                <option value="+386">+386 (SI) – Slovenia</option>
                                <option value="+677">+677 (SB) – Solomon Islands</option>
                                <option value="+252">+252 (SO) – Somalia</option>
                                <option value="+27">+27 (ZA) – South Africa</option>
                                <option value="+82">+82 (KR) – South Korea</option>
                                <option value="+211">+211 (SS) – South Sudan</option>
                                <option value="+34">+34 (ES) – Spain</option>
                                <option value="+94">+94 (LK) – Sri Lanka</option>
                                <option value="+249">+249 (SD) – Sudan</option>
                                <option value="+597">+597 (SR) – Suriname</option>
                                <option value="+46">+46 (SE) – Sweden</option>
                                <option value="+41">+41 (CH) – Switzerland</option>
                                <option value="+963">+963 (SY) – Syria</option>
                                <option value="+886">+886 (TW) – Taiwan</option>
                                <option value="+992">+992 (TJ) – Tajikistan</option>
                                <option value="+255">+255 (TZ) – Tanzania</option>
                                <option value="+66">+66 (TH) – Thailand</option>
                                <option value="+228">+228 (TG) – Togo</option>
                                <option value="+690">+690 (TK) – Tokelau</option>
                                <option value="+676">+676 (TO) – Tonga</option>
                                <option value="+1-868">+1-868 (TT) – Trinidad and Tobago</option>
                                <option value="+216">+216 (TN) – Tunisia</option>
                                <option value="+90">+90 (TR) – Turkey</option>
                                <option value="+993">+993 (TM) – Turkmenistan</option>
                                <option value="+1-649">+1-649 (TC) – Turks and Caicos Islands</option>
                                <option value="+688">+688 (TV) – Tuvalu</option>
                                <option value="+1-340">+1-340 (VI) – U.S. Virgin Islands</option>
                                <option value="+256">+256 (UG) – Uganda</option>
                                <option value="+380">+380 (UA) – Ukraine</option>
                                <option value="+971">+971 (AE) – United Arab Emirates</option>
                                <option value="+44">+44 (GB) – United Kingdom</option>
                                <option value="+1">+1 (US) – United States</option>
                                <option value="+598">+598 (UY) – Uruguay</option>
                                <option value="+998">+998 (UZ) – Uzbekistan</option>
                                <option value="+678">+678 (VU) – Vanuatu</option>
                                <option value="+379">+379 (VA) – Vatican City</option>
                                <option value="+58">+58 (VE) – Venezuela</option>
                                <option value="+84">+84 (VN) – Vietnam</option>
                                <option value="+681">+681 (WF) – Wallis and Futuna</option>
                                <option value="+967">+967 (YE) – Yemen</option>
                                <option value="+260">+260 (ZM) – Zambia</option>
                                <option value="+263">+263 (ZW) – Zimbabwe</option>
                            </select>

                            <!-- Phone Number Input -->
                            <input type="phone_number" name="phone_number" placeholder="81234567890"
                                class="w-3/4 p-3 border border-gray-300 rounded-lg " required>
                        </div>

                        <p class="mt-1 text-xs text-gray-500">
                            Enter your number without "+" or "0" at the beginning.
                            Example: <code class="bg-gray-100 px-1 py-0.5 rounded">81234567890</code>
                        </p>
                    </div>

                    <div class="w-full">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Country <span class="text-red-500">*</span>
                        </label>
                        <select name="country" required class="w-full p-3 border border-gray-300 rounded-lg bg-white ">
                            <option value="">Select country</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Australia">Australia</option>
                            <option value="United States">United States</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="Germany">Germany</option>
                            <option value="Japan">Japan</option>
                            <option value="South Korea">South Korea</option>
                            <option value="China">China</option>
                            <option value="Netherlands">Netherlands</option>
                        </select>
                    </div>
                </div>

                <!-- Special Request -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Special Requests</label>
                    <textarea name="message" rows="4"
                        placeholder="Dietary needs, room preferences, activities you love, etc..."
                        class="w-full p-3 border border-gray-300 rounded-lg "></textarea>
                    <p class="text-xs text-gray-500 mt-1">Tell us anything that matters to you.</p>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-4 px-8 rounded-lg text-lg transition-transform hover:scale-105 focus:ring-4 focus:ring-indigo-300 focus:outline-none">
                        Send My Request
                    </button>
                    <p class="text-xs text-gray-500 text-center mt-3">
                        We’ll contact you within 24 hours with a personalized package and quote.
                    </p>
                </div>
            </form>
        </div>
    </section>

    @include('components.client.footer')
@endsection