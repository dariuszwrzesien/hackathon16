import React from 'react';
import DOM from 'react-dom';
import {Router, Route, IndexRoute, hashHistory, Link} from 'react-router';
import '../sass/main.scss';

const App = React.createClass({
    propTypes: {
        children: React.PropTypes.object
    },

    render () {
        return (<div>
          <nav id="main-navbar" className="navbar">
            <div className="container">
              <div className="navbar-header">
                <button type="button" className="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                  <span className="sr-only">Toggle navigation</span>
                  <i className="fa fa-bars"></i>
                </button>
                <a className="navbar-brand" href="#">Gimme Me a name : )</a>
              </div>
            </div>
          </nav>
          {this.props.children}
          <footer>
            <div className="container">
              <div className="col-md-12">
                <p>Hackathon 2016</p>
                <p><small>All rights reserved</small></p>
              </div>
            </div>
          </footer>
        </div>);
    }
});

const HelloWorld = React.createClass({
    componentDidMount () {
      $('.panel .navigate').click(function(){
        var target = $(this).data('nav');
        $('.panel-container .panel').hide();
        $('.panel-container .panel:nth-child('+target+')').show();
        return false;
      });
    },

    render () {
        return (<section>
      <div className="container">
        <div className="row">
          <div className="col-md-10 col-md-offset-1">
            <form action="#">
              <div className="panel-container">
                <div className="panel">
                  <h2>Start</h2>
                  <div className="box thin-box">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt harum, cupiditate ipsum, excepturi at alias explicabo sapiente repudiandae, recusandae eligendi sequi assumenda fugiat ratione consequuntur aliquam inventore! Saepe, doloribus, aut.</p>
                    <button className="button button-red navigate arrow arrow-next button-center" data-nav='2'>Rozpocznij</button>
                  </div>
                </div>
                <div className="panel">
                  <h2>Lokalizacja</h2>
                  <div className="box">
                    <div className="progress-list">
                      <ul className='dots'>
                        <li className='navigate red' data-nav='2'><span></span></li>
                        <li className='bar'></li>
                        <li className='navigate' data-nav='3'><span></span></li>
                        <li className='bar'></li>
                        <li className='navigate' data-nav='4'><span></span></li>
                        <li className='bar'></li>
                        <li className='navigate' data-nav='5'><span></span></li>
                      </ul>
                    </div>
                    <p>Lorem ipsum Deserunt harum, cupiditate ipsum, excepturi at alias explicabo sapiente repudiandae, recusandae eligendi sequi assumenda fugiat ratione consequuntur aliquam inventore! Saepe, doloribus, aut.</p>
                    <input type="text" className="form-control" placeholder="Lokalizacja" />
                    <div className="row">
                      <div className="col-sm-6"></div>
                      <div className="col-sm-6">
                        <button className="button button-gray navigate arrow arrow-next" data-nav='3'>Dalej</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="panel">
                  <h2>Mapa</h2>
                  <div className="box">
                    <div className="progress-list">
                      <ul className='dots'>
                        <li className='navigate red' data-nav='2'><span></span></li>
                        <li className='bar red'></li>
                        <li className='navigate red' data-nav='3'><span></span></li>
                        <li className='bar'></li>
                        <li className='navigate' data-nav='4'><span></span></li>
                        <li className='bar'></li>
                        <li className='navigate' data-nav='5'><span></span></li>
                      </ul>
                    </div>
                    <p>TODO</p>
                    <div className="row">
                      <div className="col-sm-6">
                        <button className="button button-gray navigate arrow arrow-prev" data-nav='2'>Wstecz</button>
                      </div>
                      <div className="col-sm-6">
                        <button className="button button-gray navigate arrow arrow-next" data-nav='4'>Dalej</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="panel">
                  <h2>Opisz zgłoszenie</h2>
                  <div className="box">
                    <div className="progress-list">
                      <ul className='dots'>
                        <li className='navigate red' data-nav='2'><span></span></li>
                        <li className='bar red'></li>
                        <li className='navigate red' data-nav='3'><span></span></li>
                        <li className='bar red'></li>
                        <li className='navigate red' data-nav='4'><span></span></li>
                        <li className='bar'></li>
                        <li className='navigate' data-nav='5'><span></span></li>
                      </ul>
                    </div>
                    <p>Opisz zgłoszenie</p>
                    <textarea placeholder="Opis" className='form-control'></textarea>
                    <select className='form-control'>
                      <option>Opcja 1</option>
                      <option>Opcja 2</option>
                      <option>Opcja 3</option>
                    </select>
                    <div className="row">
                      <div className="col-sm-6">
                        <button className="button button-gray navigate arrow arrow-prev" data-nav='3'>Wstecz</button>
                      </div>
                      <div className="col-sm-6">
                        <button className="button button-red navigate arrow arrow-next" data-nav='5'>Zakończ</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="panel">
                  <h2>Zgłoszenie zostało wysłane</h2>
                  <div className="box thin-box">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt harum, cupiditate ipsum, excepturi at alias explicabo sapiente repudiandae, recusandae eligendi sequi assumenda fugiat ratione consequuntur aliquam inventore! Saepe, doloribus, aut.</p>
                    <button className="button button-red navigate button-center" data-nav='1'>Powrót na stronę główną</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>);
    }
});

const Nested = React.createClass({
    render () {
        return (<div>nested route</div>);
    }
});

const renderApp = () => {
    DOM.render(
        <Router history={hashHistory}>
            <Route component={App} path="/">
                <IndexRoute component={HelloWorld} />
                <Route component={Nested} path="nested" />
            </Route>
        </Router>,
        document.getElementById('main-container')
    );
};

renderApp();
