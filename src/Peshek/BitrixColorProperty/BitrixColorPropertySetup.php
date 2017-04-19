<?phpnamespace Peshek\BitrixColorProperty;class BitrixColorPropertySetup extends \Comodojo\Composer\EventsHandler {    protected function installOrUpdate() {        mkdir($_SERVER['DOCUMENT_ROOT'] . '/bitrix/js/jscolor.ForBitrix');        copy(__DIR__ . '/../../../install/jscolor.min.js', $_SERVER['DOCUMENT_ROOT'] . PESHEK_PATH_TO_JSCOLORMIN);        copy(__DIR__ . '/../../../install/jscolor_events.js', $_SERVER['DOCUMENT_ROOT'] . PESHEK_PATH_TO_JSCOLOREVENTS);    }    /**     * Вызывается после установки пакета     */    public function install() {        static::installOrUpdate();    }    /**     * Вызывается после обновления пакета     */    public function update() {        static ::installOrUpdate();    }    /**     * Вызывается перед деинсталляцией пакета     */    public function uninstall() {        if(!file_exists($_SERVER['DOCUMENT_ROOT'] . '/bitrix/js/jscolor.ForBitrix')) {            unlink ($_SERVER['DOCUMENT_ROOT'] . PESHEK_PATH_TO_JSCOLORMIN);            unlink ($_SERVER['DOCUMENT_ROOT'] . PESHEK_PATH_TO_JSCOLOREVENTS);            rmdir($_SERVER['DOCUMENT_ROOT'] . '/bitrix/js/jscolor.ForBitrix');        }    }    /**     * Всегда вызывается composer'ом после выполнения своей работы     * (установка, обновление, создание проекта)     */    public function finalize() {        define('PESHEK_PATH_TO_JSCOLORMIN', '/bitrix/js/jscolor.ForBitrix/jscolor.min.js');        define('PESHEK_PATH_TO_JSCOLOREVENTS', '/bitrix/js/jscolor.ForBitrix/jscolor_events.js');        AddEventHandler('iblock', 'OnIBlockPropertyBuildList', ['\\Peshek\\Properties\\ColorProperty', 'getDescription']);        AddEventHandler('main', 'OnUserTypeBuildList', ['\\Peshek\\Properties\\ColorProperty', 'getDescription']);    }}