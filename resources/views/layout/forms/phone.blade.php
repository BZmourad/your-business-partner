<div class="form-group">
    <label for="phone2" class="w-100">{{ __('Téléphone') }} <small class="text-muted" id="phone-description"></small></label>
    <div class="row">
        <div class="col-md-4 pr-0">
            <div class="form-group">
                <select name="phonecountry" class="form-control select2-phone" id="phonecountry">
                    <option value=""></option>
                    @foreach (phoneCountries() as $item)
                        <option value="{{$item['code']}}" data-TelPref="{{$item['TelPref']}}" data-description="{{$item['description']}}" data-regex="{{$item['regex']}}" data-flag="{{ asset('img/flags/' . strtolower($item['code']) . '.svg') }}" @if (old('country', $customer->country ?? '') == $item['code']) selected @endif>
                            +{{$item['TelPref']}}| {{$item['name_'.auth()->user()->lang]}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-8 pl-0">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">+</span>
                </div>
                <input type="text" class="form-control" id="phone2" name="phone2" aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function formatCountryPhone(state) {
        if (!state.id) return state.text;
        const flagUrl = $(state.element).data('flag');
        if (!flagUrl) return state.text;
        return $(`
            <span>
                <img src="${flagUrl}" class="img-flag" style="width: 20px; height: 15px; margin-right: 5px;" />
                ${state.text}
            </span>
        `);
    }
    
    function formatCountryPhoneSelection(state) {
        if (!state.id) return state.text;
        const flagUrl = $(state.element).data('flag');
        if (!flagUrl) return state.text;
        return $(`
            <span>
                <img src="${flagUrl}" class="img-flag" style="width: 20px; height: 15px;" />
            </span>
        `);
    }
    
    $(document).ready(function() {
        if ($('.select2-phone').length) {
            $('.select2-phone').select2({
                templateResult: formatCountryPhone,
                templateSelection: formatCountryPhoneSelection,
                dropdownAutoWidth: !0,
                width: "100%",
                placeholder: "",
                allowClear:!0,
                escapeMarkup: function (m) { return m; }
            });
            
            // Gestion du changement de pays
            $('#phonecountry').on('change', function() {
                const selectedOption = $(this).find('option:selected');
                const telPref = selectedOption.data('telpref');
                const regex = selectedOption.data('regex');
                const description = selectedOption.data('description');
                
                // Mettre à jour le span avec le préfixe
                if (telPref) {
                    $('#basic-addon1').text('+' + telPref);
                    $('#phone-description').text(description);
                } else {
                    $('#basic-addon1').text('+');
                    $('#phone-description').text();
                }
                
                // Activer/désactiver l'input et définir le pattern regex
                if (telPref) {
                    $('#phone2').prop('disabled', false);
                    if (regex) {
                        $('#phone2').attr('pattern', regex);
                    } else {
                        $('#phone2').removeAttr('pattern');
                    }
                } else {
                    $('#phone2').prop('disabled', true);
                    $('#phone2').val('');
                    $('#phone2').removeAttr('pattern');
                }
            });
            
            // Déclencher l'événement change au chargement si une valeur est déjà sélectionnée
            if ($('#phonecountry').val()) {
                $('#phonecountry').trigger('change');
            }
        }
    });
</script>
@endpush