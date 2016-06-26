import React from 'react';
import DOM from 'react-dom';
import {Router, Route, IndexRoute, hashHistory} from 'react-router';

import '../sass/main.scss';
import GMap from './gMap';
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

const Nested = React.createClass({
    render () {
        return (<div>nested route</div>);
    }
});

const test = a => {
    console.log(a);
};

const renderApp = () => {
    DOM.render(
        <Router history={hashHistory}>
            <Route component={App} path="/">
                <IndexRoute component={AddTicket} />
                <Route component={Nested} path="nested" />
                <Route
                    component={React.createClass({render () {
                        return <GMap address="Gliwice" setCoordinates={test} style={{width: '200px', height: '200px'}} />;
                    }})}
                    path="geo"
                />
            </Route>
        </Router>,
        document.getElementById('main-container')
    );
};

renderApp();
