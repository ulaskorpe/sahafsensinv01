<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="settings[receive_messages]" value="1" {{ old('settings.receive_messages', $userSettings->receive_messages ?? false) ? 'checked' : '' }}>
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">Mesaj alımına izin ver</span>
            </label>
        </div>
        <div class="form-group">
            <label class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="settings[friendship_allow]" value="1" {{ old('settings.friendship_allow', $userSettings->friendship_allow ?? false) ? 'checked' : '' }}>
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">Arkadaşlık isteği kabul et</span>
            </label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="settings[receive_emails]" value="1" {{ old('settings.receive_emails', $userSettings->receive_emails ?? false) ? 'checked' : '' }}>
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">E-posta bildirimleri al</span>
            </label>
        </div>
        <div class="form-group">
            <label class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="settings[bid_inform]" value="1" {{ old('settings.bid_inform', $userSettings->bid_inform ?? false) ? 'checked' : '' }}>
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">Teklif bildirimlerini aç</span>
            </label>
        </div>
    </div>
</div>