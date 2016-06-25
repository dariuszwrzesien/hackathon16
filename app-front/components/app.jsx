import React from 'react';
import DOM from 'react-dom';
import {Router, Route, IndexRoute, hashHistory, Link} from 'react-router';

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
        return (<div>Hello <Link to="/geo">world!</Link> <i className="glyphicon glyphicon-ok"></i></div>);
    }
});

const Geo = React.createClass({
    render () {
        return (<div>asdf</div>);
    }
});

const renderApp = () => {
    DOM.render(
        <Router history={hashHistory}>
            <Route component={App} path="/">
                <IndexRoute component={HelloWorld} />
                <Route component={Geo} path="geo" />
            </Route>
        </Router>,
        document.getElementById('main-container')
    );
};

renderApp();
