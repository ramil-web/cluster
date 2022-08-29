
/*^^^^^^^^^^^^^^^^^^^^Плагины */
//https://github.com/garand/sticky
//"Липкие" объекты
require('./libs/jquery.sticky');
/*____________________Плагины */
/*^^^^^^^^^^^^^^^^^^^^Вывод кода в тексте */
//https://github.com/google/code-prettify
window.code_prettify = require('code-prettify');
PR.prettyPrint();
/*____________________Вывод кода в тексте */
/*^^^^^^^^^^^^^^^^^^^^Галерея */
//http://dimsemenov.com/plugins/magnific-popup/documentation.html#gallery
require('magnific-popup');
/*____________________Галерея */

/*^^^^^^^^^^^^^^^^^^^^Плагины */
require('./plugins/main');
/*____________________Плагины */

/*^^^^^^^^^^^^^^^^^^^^LAYOUTS */
require('./layouts/header/header');
require('./layouts/footer/footer');
/*____________________LAYOUTS */
/*^^^^^^^^^^^^^^^^^^^^PAGES */
require('./pages/main');
/*____________________PAGES */






