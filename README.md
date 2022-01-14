# Aligent_LiveChat module

#### Description:
Aligent LiveChat Module included below changes.
- Add system configuration fields for livechat_license_number , livechat_groups , livechat_params.
- Create frontend page which will input the livechat_license_number , livechat_groups , livechat_params fields from form & once the form is submitted , update the livechat_license_number , livechat_groups , livechat_params configuration fields.
- Create admin page which will input the livechat_license_number , livechat_groups , livechat_params fields from form & once the form is submitted , update the livechat_license_number , livechat_groups , livechat_params configuration fields.
- Once the form is submitted, send an email to the admin . Email contains dynamic values for livechat_license_number , livechat_groups , livechat_params. 
- Once the form is submitted, store the post records in a custom table to track the time to time changes.
- Admin Grid to display the custom table records (livechat_license_number , livechat_groups , livechat_params)  

#### Installation

Add repository to composer.json

```sh
composer config repositories.aligent-livechat git https://github.com/vinojkarunarathne/-aligent-exam-part2.git
```

Install module

```sh
composer require aligent/module-livechat:2.43.0
```

#### Changelog
[2.43.0]  Initial Module Creation


#### Demo Video Link 
https://share.vidyard.com/watch/BmhzLRbiTKpi5EV8phdKU8?
