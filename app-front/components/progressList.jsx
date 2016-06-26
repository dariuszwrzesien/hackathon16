import React from 'react';

const ProgressList = React.createClass({
  propTypes: {
    progress: React.PropTypes.number.isRequired,
    steps: React.PropTypes.number.isRequired
  },

  renderSteps () {
    return Array(this.props.steps * 2).fill().reduce((elements, _, index) => {
      const step = index / 2;
      return index % 2
        ? [...elements, <li className={`bar ${step + 1< this.props.progress ? 'red': ''}`}></li>]
        : [...elements, <li className={`navigate ${step < this.props.progress ? 'red': ''}`} data-nav={step + 2}><span></span></li>]
    }, []).slice(0, -1);
  },

  render () {
    return (
      <div className="progress-list">
        <ul className='dots'>
          {this.renderSteps()}
        </ul>
      </div>
    );
  }
});

export default ProgressList;