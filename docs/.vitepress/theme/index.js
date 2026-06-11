// .vitepress/theme/index.js
import DefaultTheme from 'vitepress/theme';
import './custom.css';
import NestedNavMenu from './components/NestedNavMenu.vue';
import MyLayout from './MyLayout.vue';

export default {
  extends: DefaultTheme,
  Layout: MyLayout,
  enhanceApp({ app }) {
    app.component('NestedNavMenu', NestedNavMenu);
  },
};
