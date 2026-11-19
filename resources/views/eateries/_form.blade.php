@if ($errors->any())
    <div class="mb-6 rounded border border-red-300 bg-red-50 p-4">
        <p class="font-semibold text-red-800">Please correct the following errors.</p>
        <ul class="list-disc pl-5 text-sm text-red-700">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label for="name" class="block font-medium">Name</label>
        <input id="name" name="name" type="text" value="{{ old('name', $eatery->name ?? '') }}" class="mt-1 w-full rounded border p-2">
        @error('name') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="district_id" class="block font-medium">District</label>
        <select id="district_id" name="district_id" class="mt-1 w-full rounded border p-2">
            <option value="">Select district</option>
            @foreach ($districts as $district)
                <option value="{{ $district->id }}" @selected(old('district_id', $eatery->district_id ?? '') == $district->id)>{{ $district->name }}</option>
            @endforeach
        </select>
        @error('district_id') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="address" class="block font-medium">Address</label>
        <input id="address" name="address" type="text" value="{{ old('address', $eatery->address ?? '') }}" class="mt-1 w-full rounded border p-2">
        @error('address') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="price_range" class="block font-medium">Price range</label>
        <select id="price_range" name="price_range" class="mt-1 w-full rounded border p-2">
            <option value="">Select price range</option>
            <option value="budget" @selected(old('price_range', $eatery->price_range ?? '') === 'budget')>₱ Budget</option>
            <option value="mid" @selected(old('price_range', $eatery->price_range ?? '') === 'mid')>₱₱ Mid</option>
            <option value="splurge" @selected(old('price_range', $eatery->price_range ?? '') === 'splurge')>₱₱₱ Splurge</option>
        </select>
        @error('price_range') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="specialty" class="block font-medium">Specialty</label>
        <input id="specialty" name="specialty" type="text" value="{{ old('specialty', $eatery->specialty ?? '') }}" class="mt-1 w-full rounded border p-2">
        @error('specialty') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
    </div>
    <div class="flex items-end pb-2">
        <label class="flex items-center gap-2">
            <input type="hidden" name="is_open" value="0">
            <input type="checkbox" name="is_open" value="1" @checked(old('is_open', $eatery->is_open ?? true))>
            Open
        </label>
        @error('is_open') <p class="ml-3 text-sm text-red-700">{{ $message }}</p> @enderror
    </div>
</div>

<fieldset class="mt-5">
    <legend class="font-medium">Features</legend>
    @php($selectedFeatures = old('features', isset($eatery) ? $eatery->features->pluck('id')->all() : []))
    <div class="mt-2 flex flex-wrap gap-4">
        @foreach ($features as $feature)
            <label class="flex items-center gap-2">
                <input type="checkbox" name="features[]" value="{{ $feature->id }}" @checked(in_array($feature->id, $selectedFeatures))>
                {{ $feature->name }}
            </label>
        @endforeach
    </div>
    @error('features') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
    @error('features.*') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
</fieldset>

<div class="mt-5 grid gap-4 md:grid-cols-2">
    <div>
        <label for="permit_no" class="block font-medium">Permit number</label>
        <input id="permit_no" name="permit_no" type="text" value="{{ old('permit_no', $eatery->permit->permit_no ?? '') }}" class="mt-1 w-full rounded border p-2">
        @error('permit_no') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="expires_on" class="block font-medium">Permit expiry date</label>
        <input id="expires_on" name="expires_on" type="date" value="{{ old('expires_on', isset($eatery->permit) ? $eatery->permit->expires_on->format('Y-m-d') : '') }}" class="mt-1 w-full rounded border p-2">
        @error('expires_on') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
    </div>
</div>
