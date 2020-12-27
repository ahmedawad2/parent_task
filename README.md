## Requirements

PHP 7.3 or higher with the Ctype and Intl extensions.

## Installation

<ul>
<li>clone the project.</li>
<li>copy .env.example to .env.</li>
<li>place data files in an accessible path in the project and update the env variable PROVIDERS_PATH accordingly.</li>
<li>register your providers in config/data_providers file.</li>
<li>(note): app assumes file name = PROVIDER_NAME.json, e.g: a provider called DataProviderX shall have a corresponding json file named DataProviderX.json in the specified path.</li>
</ul>

## Note

<p>Task was made using Laravel 8.20.1.</p>
<p>i used this: <a href="https://github.com/pcrov/JsonReader">Package</a> to manipulate large json files.</p>
<p>Task covered those evaluation aspects only (unfortunately !) <ul>
<li>Code quality.</li>
<li>Application performance in reading large files.</li>
<li>Code scalability : ability to add DataProviderZ by small changes.
</li>
</ul></p>

