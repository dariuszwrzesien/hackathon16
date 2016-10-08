import React from 'react';

const TakePicture = React.createClass({
  propTypes: {
    clearPicture: React.PropTypes.func.isRequired,
    newPictureTaken: React.PropTypes.func.isRequired
  },

  getInitialState () {
    return {
      url: ''
    };
  },

  getPicture (event) {
    if (!event.target.files.length) {
      this.props.clearPicture();
      return;
    }

    const file = event.target.files[0];
    this.props.newPictureTaken(file);
  },

  render () {
    return (
      <div>
        <img src={this.state.url} />
        <input name="picture" type="file" accept="image/*" onChange={this.getPicture} />
      </div>
    );
  }
});

export default TakePicture;
