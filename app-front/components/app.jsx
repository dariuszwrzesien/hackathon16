import React from 'react';
import DOM from 'react-dom';
import {Router, Route, IndexRoute, browserHistory} from 'react-router';

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
        return (<div>Hello world! <i className="glyphicon glyphicon-ok"></i></div>);
    }
});

const renderApp = () => {
    DOM.render(
        <Router history={browserHistory}>
            <Route component={App} path="/">
                <IndexRoute component={HelloWorld} />
            </Route>
        </Router>,
        document.getElementById('main-container')
    );
};

renderApp();
