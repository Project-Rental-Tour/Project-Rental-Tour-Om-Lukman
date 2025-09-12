@extends('_layouts.user')

@section('content')
    @include('components.client.navbar')

    <!-- Hero Section -->
    <section class="relative bg-gray-900 text-white h-96" id="jumbotron">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <img loading="lazy" src="{{ asset($destination->destination_photo) }}" alt="{{ $destination->name_package }}"
            class="w-full h-full object-cover object-center">

        <div class="absolute inset-0 flex items-center">
            <div class="container mx-auto px-6">
                <div class="max-w-3xl">
                    <span class="bg-blue-600 text-white text-sm px-3 py-1 rounded-full mb-4 inline-block">
                        {{ ucfirst($destination->category) }} Trip
                    </span>
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $destination->name_package }}</h1>
                    <p class="text-xl text-blue-200 mb-6">{{ $destination->place }} • {{ $destination->time }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <nav class="bg-white py-4 shadow-sm">
        <div class="container mx-auto px-6">
            <ol class="flex space-x-2 text-sm text-gray-600">
                <li>Home</li>
                <li class="text-gray-400">/</li>
                <li>Destinations</li>
                <li class="text-gray-400">/</li>
                <li class="text-gray-900">{{ $destination->name_package }}</li>
            </ol>
        </div>
    </nav>

    <!-- Booking Form -->
    <section class="container mx-auto px-6 py-12">
        <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-blue-600 text-white p-6">
                <h2 class="text-2xl font-bold">Complete Your Booking</h2>
                <p class="text-blue-100">Fill in your details to confirm your trip.</p>
            </div>

            <form action="{{ route('booking.regular.store') }}" method="POST" class="p-8 space-y-6">
                @csrf

                <!-- Hidden: Destination ID -->
                <input type="hidden" name="destination_id" value="{{ $destination->destination_id }}">

                <!-- Destination Info -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-gray-800">{{ $destination->name_package }}</h3>
                    <p class="text-gray-600">{{ $destination->place }} • {{ $destination->time }}</p>
                    <p class="text-lg font-bold text-blue-600 mt-1">
                        Rp{{ number_format($destination->price, 0, ',', '.') }} / person
                    </p>
                </div>

                <!-- Personal Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- First Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                        <input type="text" name="first_name" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Enter your first name" autocomplete="given-name">
                        @error('first_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                        <input type="text" name="last_name" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Enter your last name" autocomplete="family-name">
                        @error('last_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                </div>
                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Enter your email" autocomplete="email">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Phone Number <span class="text-red-500">*</span>
                    </label>

                    <div class="flex gap-2">
                        <!-- Country Code -->
                        <select name="country_code" id="country_code"
                            class="w-1/4 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required>
                            <option value="" disabled selected>Select Code</option>
                            <option value="+93">+93 (AF) – Afghanistan</option>
                            <option value="+355">+355 (AL) – Albania</option>
                            <option value="+213">+213 (DZ) – Algeria</option>
                            <option value="+1-684">+1-684 (AS) – American Samoa</option>
                            <option value="+376">+376 (AD) – Andorra</option>
                            <option value="+244">+244 (AO) – Angola</option>
                            <option value="+1-264">+1-264 (AI) – Anguilla</option>
                            <option value="+1-268">+1-268 (AG) – Antigua</option>
                            <option value="+54">+54 (AR) – Argentina</option>
                            <option value="+374">+374 (AM) – Armenia</option>
                            <option value="+297">+297 (AW) – Aruba</option>
                            <option value="+61">+61 (AU) – Australia</option>
                            <option value="+43">+43 (AT) – Austria</option>
                            <option value="+994">+994 (AZ) – Azerbaijan</option>
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
                            <option value="+387">+387 (BA) – Bosnia</option>
                            <option value="+267">+267 (BW) – Botswana</option>
                            <option value="+55">+55 (BR) – Brazil</option>
                            <option value="+1">+1 (CA) – Canada</option>
                            <option value="+238">+238 (CV) – Cape Verde</option>
                            <option value="+1-345">+1-345 (KY) – Cayman</option>
                            <option value="+236">+236 (CF) – CAR</option>
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
                            <option value="+420">+420 (CZ) – Czechia</option>
                            <option value="+243">+243 (CD) – DRC</option>
                            <option value="+45">+45 (DK) – Denmark</option>
                            <option value="+253">+253 (DJ) – Djibouti</option>
                            <option value="+1-767">+1-767 (DM) – Dominica</option>
                            <option value="+1-809">+1-809 (DO) – Dominican</option>
                            <option value="+593">+593 (EC) – Ecuador</option>
                            <option value="+20">+20 (EG) – Egypt</option>
                            <option value="+503">+503 (SV) – El Salvador</option>
                            <option value="+240">+240 (GQ) – Guinea</option>
                            <option value="+291">+291 (ER) – Eritrea</option>
                            <option value="+372">+372 (EE) – Estonia</option>
                            <option value="+251">+251 (ET) – Ethiopia</option>
                            <option value="+298">+298 (FO) – Faroe</option>
                            <option value="+679">+679 (FJ) – Fiji</option>
                            <option value="+358">+358 (FI) – Finland</option>
                            <option value="+33">+33 (FR) – France</option>
                            <option value="+241">+241 (GA) – Gabon</option>
                            <option value="+220">+220 (GM) – Gambia</option>
                            <option value="+995">+995 (GE) – Georgia</option>
                            <option value="+49">+49 (DE) – Germany</option>
                            <option value="+233">+233 (GH) – Ghana</option>
                            <option value="+350">+350 (GI) – Gibraltar</option>
                            <option value="+30">+30 (GR) – Greece</option>
                            <option value="+299">+299 (GL) – Greenland</option>
                            <option value="+1-473">+1-473 (GD) – Grenada</option>
                            <option value="+502">+502 (GT) – Guatemala</option>
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
                            <option value="+972">+972 (IL) – Israel</option>
                            <option value="+39">+39 (IT) – Italy</option>
                            <option value="+225">+225 (CI) – Ivory Coast</option>
                            <option value="+1-876">+1-876 (JM) – Jamaica</option>
                            <option value="+81">+81 (JP) – Japan</option>
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
                            <option value="+389">+389 (MK) – Macedonia</option>
                            <option value="+261">+261 (MG) – Madagascar</option>
                            <option value="+265">+265 (MW) – Malawi</option>
                            <option value="+60">+60 (MY) – Malaysia</option>
                            <option value="+960">+960 (MV) – Maldives</option>
                            <option value="+223">+223 (ML) – Mali</option>
                            <option value="+356">+356 (MT) – Malta</option>
                            <option value="+692">+692 (MH) – Marshall</option>
                            <option value="+222">+222 (MR) – Mauritania</option>
                            <option value="+230">+230 (MU) – Mauritius</option>
                            <option value="+52">+52 (MX) – Mexico</option>
                            <option value="+691">+691 (FM) – Micronesia</option>
                            <option value="+373">+373 (MD) – Moldova</option>
                            <option value="+377">+377 (MC) – Monaco</option>
                            <option value="+976">+976 (MN) – Mongolia</option>
                            <option value="+382">+382 (ME) – Montenegro</option>
                            <option value="+212">+212 (MA) – Morocco</option>
                            <option value="+258">+258 (MZ) – Mozambique</option>
                            <option value="+95">+95 (MM) – Myanmar</option>
                            <option value="+264">+264 (NA) – Namibia</option>
                            <option value="+674">+674 (NR) – Nauru</option>
                            <option value="+977">+977 (NP) – Nepal</option>
                            <option value="+31">+31 (NL) – Netherlands</option>
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
                            <option value="+974">+974 (QA) – Qatar</option>
                            <option value="+40">+40 (RO) – Romania</option>
                            <option value="+7">+7 (RU) – Russia</option>
                            <option value="+250">+250 (RW) – Rwanda</option>
                            <option value="+685">+685 (WS) – Samoa</option>
                            <option value="+381">+381 (RS) – Serbia</option>
                            <option value="+248">+248 (SC) – Seychelles</option>
                            <option value="+232">+232 (SL) – Sierra Leone</option>
                            <option value="+65">+65 (SG) – Singapore</option>
                            <option value="+421">+421 (SK) – Slovakia</option>
                            <option value="+386">+386 (SI) – Slovenia</option>
                            <option value="+27">+27 (ZA) – South Africa</option>
                            <option value="+82">+82 (KR) – South Korea</option>
                            <option value="+34">+34 (ES) – Spain</option>
                            <option value="+94">+94 (LK) – Sri Lanka</option>
                            <option value="+46">+46 (SE) – Sweden</option>
                            <option value="+41">+41 (CH) – Switzerland</option>
                            <option value="+90">+90 (TR) – Turkey</option>
                            <option value="+998">+998 (UZ) – Uzbekistan</option>
                            <option value="+84">+84 (VN) – Vietnam</option>
                        </select>

                        <!-- Phone Number -->
                        <input type="tel" name="phone_number" placeholder="81234567890"
                            class="w-3/4 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required>
                    </div>

                    <p class="mt-1 text-xs text-gray-500">
                        Enter your number without "+" or "0" at the beginning.
                        Example: <code class="bg-gray-100 px-1 py-0.5 rounded">81234567890</code>
                    </p>
                </div>

                <!-- Country -->
                <div>
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

                <!-- Travel Date -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Travel Date</label>
                    <input type="date" name="travel_date" required class="w-full px-4 py-2 border border-gray-300 rounded-lg
                            focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        min="{{ now()->addDay()->format('Y-m-d') }}">
                    @error('travel_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Special Request -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Special Request (Optional)</label>
                    <textarea name="message" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="e.g., Dietary preferences, accessibility needs..."></textarea>
                    @error('message')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href=" {{ route('destination.show', $destination->slug) }}" class="w-full sm:w-auto text-center px-6 py-3 border border-gray-300 text-gray-700 rounded-lg
                        hover:bg-gray-50 transition">
                        Back to Details
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Confirm Booking
                    </button>
                </div>
            </form>
        </div>
    </section>

    <a 
        href="https://wa.me/6281220005276?text=Hello%20Septem%20Tour!%20I%27d%20like%20to%20get%20some%20information%3A%0A-%20Destination%3A%20%5BEnter%20your%20preferred%20destination%5D%0A-%20Number%20of%20Travelers%3A%20%5BEnter%20number%5D%0A-%20Travel%20Date%3A%20%5BEnter%20date%5D%0A-%20Additional%20Requests%3A%20%5BType%20here%5D%0A%0AThank%20you!" 
        target="_blank"
        id="whatsapp-float"
        class="fixed bottom-6 right-6 bg-green-500 text-white px-4 py-3 rounded-full shadow-lg hover:bg-green-600 transition-all duration-300 transform scale-0 opacity-0 z-50 flex items-center gap-2 group animate-bounce-slow"
    >
        <i class="fab fa-whatsapp text-2xl"></i>
        <span class="whatsapp-text font-medium whitespace-nowrap">Need Help?</span>
    </a>

    @include('components.client.footer')
    @push('scripts')
        <script src="{{ asset('assets/js/whatsAppIcon.js') }}" ></script>
    @endpush
@endsection