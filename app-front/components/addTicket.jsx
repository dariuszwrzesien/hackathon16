import React from 'react';

import ProgressList from './progressList';
import GMap from './gMap';

const AddTicket = React.createClass({
    getInitialState () {
        return {
            category: 1,
            categories: [],
            panel: 0,
            coordinates: {},
            locationAddress: ''
        };
    },

    componentWillMount () {
      $.ajax({
        url: '/api/categories',
        success: result => {
          this.setState({
            categories: result
          });
        }
      });
    },

    setCategory (event) {
        this.setState({
            category: Number(event.target.value)
        });
    },

    addTicket () {
        const {latitude, longitude} = this.state.coordinates;
        const newTicket = {
            description: this.description.value,
            latitude,
            longitude,
            category: this.state.category
        };

        $.ajax({
            method: 'POST',
            url: '/api/tickets',
            data: newTicket
        });
    },

    renderCategories () {
        var buffer = [];
            for (var i = 0; i < this.state.categories.length; i++ ) {
                var html = <option key={this.state.categories[i].id} value={this.state.categories[i].id}>{this.state.categories[i].name}</option>;
                buffer.push(html);
            }
        return buffer;
    },

    toggleMap () {
        this.setState(oldState => {
            return {
                toggleMap: !oldState.toggleMap
            };
        });
    },

    showPanel (panel) {
        this.setState({panel});
    },

    renderPanel (panel) {
        const panels = [
            () => <div className="panel">
                <h2>Start</h2>
                <div className="box thin-box">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt harum, cupiditate ipsum, excepturi at alias explicabo sapiente repudiandae, recusandae eligendi sequi assumenda fugiat ratione consequuntur aliquam inventore! Saepe, doloribus, aut.</p>
                    <button
                        className="button button-red navigate arrow arrow-next button-center"
                        onClick={this.showPanel.bind(null, 1)}
                        type="button"
                    >Rozpocznij</button>
                </div>
            </div>,
            () => {
                const setLocationAddress = (event) => this.setState({
                    locationAddress: event.target.value
                });

                return (
                    <div className="panel">
                        <h2>Lokalizacja</h2>
                        <div className="box">
                            <ProgressList
                                progress={1}
                                steps={4}
                            />
                            <p>Lorem ipsum Deserunt harum, cupiditate ipsum, excepturi at alias explicabo sapiente repudiandae, recusandae eligendi sequi assumenda fugiat ratione consequuntur aliquam inventore! Saepe, doloribus, aut.</p>
                            <input
                                className="form-control"
                                onChange={setLocationAddress}
                                placeholder="Lokalizacja"
                                type="text"
                                value={this.state.locationAddress}
                            />
                            <div className="row">
                                <div className="col-sm-offset-6 col-sm-6">
                                    <button
                                        className="button button-gray navigate arrow arrow-next"
                                        onClick={this.showPanel.bind(null, 2)}
                                        type="button"
                                    >Dalej</button>
                                </div>
                            </div>
                        </div>
                    </div>
                );
            },
            () => {
                const setCoordinates = coordinates => this.setState({
                    coordinates
                });

                return (<div className="panel">
                    <h2>Mapa</h2>
                    <div className="box">
                        <ProgressList
                            progress={2}
                            steps={4}
                        />
                        <GMap
                            address={this.state.locationAddress}
                            setCoordinates={setCoordinates}
                            style={{width: '100%', height: '300px'}}
                        />
                        <div className="row">
                            <div className="col-sm-6">
                                <button
                                    className="button button-gray navigate arrow arrow-prev"
                                    onClick={this.showPanel.bind(null, 1)}
                                    type="button"
                                >Wstecz</button>
                            </div>
                            <div className="col-sm-6">
                                <button
                                    className="button button-gray navigate arrow arrow-next"
                                    onClick={this.showPanel.bind(null, 3)}
                                    type="button"
                                >Dalej</button>
                            </div>
                        </div>
                    </div>
                </div>);
            },
            () => {
                const showLastPanel = () => {
                    this.showPanel(4);
                    this.addTicket();
                };
                return (
                    <div className="panel">
                        <h2>Opisz zgłoszenie</h2>
                        <div className="box">
                            <ProgressList
                                progress={3}
                                steps={4}
                            />
                            <p>Opisz zgłoszenie</p>
                            <textarea
                                className='form-control'
                                placeholder="Opis"
                                ref={r => this.description = r}
                            ></textarea>
                            <select
                                className='form-control'
                                onChange={this.setCategory}
                                value={this.state.category}
                            >
                                {this.renderCategories()}
                            </select>
                            <div className="row">
                                <div className="col-sm-6">
                                    <button
                                        className="button button-gray navigate arrow arrow-prev"
                                        onClick={this.showPanel.bind(null, 2)}
                                        type="button"
                                    >Wstecz</button>
                                </div>
                                <div className="col-sm-6">
                                    <button
                                        className="button button-red navigate arrow arrow-next"
                                        onClick={showLastPanel}
                                        type="button"
                                    >Zakończ</button>
                                </div>
                            </div>
                        </div>
                    </div>);
            },
            () => {
                const reset = () => this.setState(this.getInitialState());

                return (
                    <div className="panel">
                        <h2>Zgłoszenie zostało wysłane</h2>
                        <div className="box thin-box">
                            <ProgressList
                                progress={4}
                                steps={4}
                            />
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt harum, cupiditate ipsum, excepturi at alias explicabo sapiente repudiandae, recusandae eligendi sequi assumenda fugiat ratione consequuntur aliquam inventore! Saepe, doloribus, aut.</p>
                            <button
                                className="button button-red navigate button-center"
                                onClick={reset}
                                type="button"
                            >Powrót na stronę główną</button>
                          </div>
                    </div>);
            }
        ];

        if (this.state.panel !== panel) {
            return null;
        }

        return panels[panel]();
    },

    render () {
        return (<section>
            <div className="container">
                <div className="row">
                    <div className="col-md-10 col-md-offset-1">
                        <form action="#">
                            <div className="panel-container">
                                {this.renderPanel(0)}
                                {this.renderPanel(1)}
                                {this.renderPanel(2)}
                                {this.renderPanel(3)}
                                {this.renderPanel(4)}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>);
    }
});

export default AddTicket;
