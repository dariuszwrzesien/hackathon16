import React from 'react';

const Geo = React.createClass({
    getInitialState () {
        const locationEnabled = Boolean('geolocation' in navigator);

        if (locationEnabled) {
            navigator.geolocation.getCurrentPosition(position => {
                const {latitude, longitude} = position.coords;
                this.setState({position: {latitude, longitude}});
            });
        }

        return {
            showMap: locationEnabled
        };
    },

    renderLocationQuestion () {
        if (this.state.showMap) {
            return null;
        }

        return (
            <div>
                <p>Nie możemy pobrać lokacji automatycznie, napisz gdzie jesteś:</p>
                <p>input here</p>
            </div>
        );
    },

    renderMap () {
        if (!this.state.showMap) {
            return null;
        }

        return (<div>map here {JSON.stringify(this.state.position)}</div>);
    },

    render () {
        return (
            <div className="Geo">
                {this.renderLocationQuestion()}
                {this.renderMap()}
            </div>
        );
    }
});

export default Geo;
