import { PlumaPage } from './app.po';

describe('pluma App', () => {
  let page: PlumaPage;

  beforeEach(() => {
    page = new PlumaPage();
  });

  it('should display welcome message', done => {
    page.navigateTo();
    page.getParagraphText()
      .then(msg => expect(msg).toEqual('Welcome to app!!'))
      .then(done, done.fail);
  });
});
