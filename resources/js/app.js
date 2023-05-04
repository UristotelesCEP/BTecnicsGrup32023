import './bootstrap';
import * as bootstrap from 'bootstrap';

import { createApp } from 'vue';
import CartaTrucada from './components/CartaTrucada.vue';


var elemento = createApp(CartaTrucada).mount('#app');
console.log(elemento);
//alert(elemento.$root);