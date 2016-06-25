import React from 'react';

import googleMaps from '../services/googleMaps';

const Geo = React.createClass({
    getInitialState () {
        return {};
    },

    componentWillMount () {
        const locationEnabled = Boolean('geolocation' in navigator);

        if (locationEnabled) {
            navigator.geolocation.getCurrentPosition(
                position => {
                    const {latitude, longitude} = position.coords;
                    this.setState({position: {latitude, longitude}});
                }
            );
        }
    },

    showMapOnAddress () {
        googleMaps.getCoords(this.addressInput.value)
            .then(
                coords => this.setState({position: coords, showMap: true}),
                rejection => console.log('could not get coords for address', rejection)
            );
    },

    renderLocationQuestion () {
        if (this.state.position) {
            return null;
        }

        return (
            <div>
                <p>Nie możemy pobrać lokacji automatycznie, napisz gdzie jesteś:</p>
                <input ref={ref => this.addressInput = ref} type="text" />
                <button
                    onClick={this.showMapOnAddress}
                    type="submit"
                >Find</button>
            </div>
        );
    },

    renderMap () {
        if (!this.state.position) {
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
