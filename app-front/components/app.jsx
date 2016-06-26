import React from 'react';
import DOM from 'react-dom';
import {Router, Route, IndexRoute, hashHistory, Link} from 'react-router';
import GMap from './gMap';

const App = React.createClass({
    propTypes: {
        children: React.PropTypes.object
    },

    render () {
        return (<div>{this.props.children}</div>);
    }
});

const HelloWorld = React.createClass({
    render () {
        return (<div>Hello <Link to="/nested">world!</Link> <i className="glyphicon glyphicon-ok"></i></div>);
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
                <IndexRoute component={HelloWorld} />
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
