import React from 'react';
import DOM from 'react-dom';

const App = React.createClass({
    render () {
        return (<div>Hello world! <i className="glyphicon glyphicon-ok"></i></div>);
    }
});

const renderApp = () => {
    DOM.render(
        <App />,
        document.getElementById('main-container')
    );
};

renderApp();
