import Vue from 'vue';
import Router from 'vue-router';
import routes from './routes';
import { ifAuthenticated } from '@/middlewares/authenticatable'

Vue.use(Router);

const router = new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes,
});

/**
 * Modify data before routes render into page.
 *
 * @param to, from, next
 * @return void
 */
router.beforeEach((to, from, next) => {
  /**
   * This goes through the matched routes from last to first,
   * finding the closest route with a title.
   * eg. if we have /some/deep/nested/route
   * and /some, /deep, and /nested have titles, nested's will be chosen.
   */
  const route = to.matched.slice().reverse().find(r => r.meta && r.meta.title);

  if (route) {
    document.title = route.meta.title;
    if (route.meta.metatags) {
      // TODO: do the metatags
    }
  }

  if (route.meta.authenticatable) {
    ifAuthenticated(to, from, next)
    return
  }

  next();
});

export default router;
