import React from 'react';
import _ from 'lodash';
import {GoogleMapLoader, GoogleMap, Marker} from 'react-google-maps';
import {triggerEvent} from 'react-google-maps/lib/utils';

import googleMaps from '../services/googleMaps';

const Map = React.createClass({
    propTypes: {
        address: React.PropTypes.string.isRequired,
        setCoordinates: React.PropTypes.func,
        style: React.PropTypes.object,
        updateOnResize: React.PropTypes.bool
    },

    getInitialState () {
        return {
            ready: false,
            markers: []
        };
    },

    componentWillMount () {
        this.handleWindowResize = _.throttle(this.handleWindowResize, 500);
        googleMaps.getCoords(this.props.address)
            .then(
                coords => {
                    const {longitude, latitude} = coords;
                    const googleMapsCoords = {lat: latitude, lng: longitude};
                    this.notifyAboutNewCoordinates(coords);
                    this.setState({
                        position: googleMapsCoords,
                        ready: true,
                        marker: {
                            position: googleMapsCoords,
                            key: this.props.address,
                            defaultAnimation: 2
                        }
                    });
                },
                rejection => this.setState({locationError: rejection, ready: true})
            );
    },

    componentDidMount () {
        if (this.props.updateOnResize) {
            window.addEventListener('resize', this.handleWindowResize);
        }
    },

    componentWillUnmount () {
        window.removeEventListener('resize', this.handleWindowResize);
    },

    handleWindowResize () {
        triggerEvent(this._googleMapComponent, 'resize');
    },

    notifyAboutNewCoordinates (coords) {
        if (!this.props.setCoordinates) {
            return;
        }

        this.props.setCoordinates(coords);
    },

    renderLoadingIndicator () {
        if (!this.state.ready) {
            return '...loading...';
        }

        return null;
    },

    renderError () {
        if (this.state.locationError) {
            return <div className="aler alert-error">We couldn't get the specified location.</div>;
        }

        return null;
    },

    handleMapClick (event) {
        this.setState({
            marker: {
                position: event.latLng,
                defaultAnimation: 2,
                key: Date.now()
            }
        });

        this.notifyAboutNewCoordinates({longitude: event.latLng.lng(), latitude: event.latLng.lat()});
    },

    renderMap () {
        if (!this.state.position) {
            return null;
        }

        return (
            <GoogleMapLoader
                containerElement={
                    <div
                        {...this.props}
                        style={{
                            height: '100%',
                            width: '100%'
                        }}
                    />
                }
                googleMapElement={
                    <GoogleMap
                        defaultCenter={this.state.position}
                        defaultZoom={15}
                        onClick={this.handleMapClick}
                        ref={map => (this._googleMapComponent = map)}
                    >
                        <Marker
                            {...this.state.marker}
                        />
                    </GoogleMap>
                }
            />
        );
    },

    render () {
        return (
            <div className="Map" style={this.props.style}>
                {this.renderLoadingIndicator()}
                {this.renderError()}
                {this.renderMap()}
            </div>
        );
    }
});

export default Map;
