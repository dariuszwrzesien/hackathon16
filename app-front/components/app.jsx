import React from 'react';
import DOM from 'react-dom';
import {Router, Route, IndexRoute, hashHistory} from 'react-router';

import '../less/main.less';
import AddTicket from './addTicket';

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

const renderApp = () => {
    DOM.render(
        <Router history={hashHistory}>
            <Route component={App} path="/">
                <IndexRoute component={AddTicket} />
            </Route>
        </Router>,
        document.getElementById('main-container')
    );
};

renderApp();
