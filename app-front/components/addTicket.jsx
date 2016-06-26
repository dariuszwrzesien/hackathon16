import React from 'react';

import ProgressList from './progressList';

const AddTicket = React.createClass({
    componentDidMount () {
      $('.panel .navigate').click(function(){
        var target = $(this).data('nav');
        $('.panel-container .panel').hide();
        $('.panel-container .panel:nth-child('+target+')').show();
        return false;
      });
    },

    render () {
        return (<section>
      <div className="container">
        <div className="row">
          <div className="col-md-10 col-md-offset-1">
            <form action="#">
              <div className="panel-container">
                <div className="panel">
                  <h2>Start</h2>
                  <div className="box thin-box">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt harum, cupiditate ipsum, excepturi at alias explicabo sapiente repudiandae, recusandae eligendi sequi assumenda fugiat ratione consequuntur aliquam inventore! Saepe, doloribus, aut.</p>
                    <button className="button button-red navigate arrow arrow-next button-center" data-nav='2'>Rozpocznij</button>
                  </div>
                </div>
                <div className="panel">
                  <h2>Lokalizacja</h2>
                  <div className="box">
                    <ProgressList
                      progress={1}
                      steps={4}
                    />
                    <p>Lorem ipsum Deserunt harum, cupiditate ipsum, excepturi at alias explicabo sapiente repudiandae, recusandae eligendi sequi assumenda fugiat ratione consequuntur aliquam inventore! Saepe, doloribus, aut.</p>
                    <input type="text" className="form-control" placeholder="Lokalizacja" />
                    <div className="row">
                      <div className="col-sm-6"></div>
                      <div className="col-sm-6">
                        <button className="button button-gray navigate arrow arrow-next" data-nav='3'>Dalej</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="panel">
                  <h2>Mapa</h2>
                  <div className="box">
                    <ProgressList
                      progress={2}
                      steps={4}
                    />
                    <p>TODO</p>
                    <div className="row">
                      <div className="col-sm-6">
                        <button className="button button-gray navigate arrow arrow-prev" data-nav='2'>Wstecz</button>
                      </div>
                      <div className="col-sm-6">
                        <button className="button button-gray navigate arrow arrow-next" data-nav='4'>Dalej</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="panel">
                  <h2>Opisz zgłoszenie</h2>
                  <div className="box">
                    <ProgressList
                      progress={3}
                      steps={4}
                    />
                    <p>Opisz zgłoszenie</p>
                    <textarea placeholder="Opis" className='form-control'></textarea>
                    <select className='form-control'>
                      <option>Opcja 1</option>
                      <option>Opcja 2</option>
                      <option>Opcja 3</option>
                    </select>
                    <div className="row">
                      <div className="col-sm-6">
                        <button className="button button-gray navigate arrow arrow-prev" data-nav='3'>Wstecz</button>
                      </div>
                      <div className="col-sm-6">
                        <button className="button button-red navigate arrow arrow-next" data-nav='5'>Zakończ</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="panel">
                  <h2>Zgłoszenie zostało wysłane</h2>
                  <div className="box thin-box">
                    <ProgressList
                      progress={4}
                      steps={4}
                    />
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt harum, cupiditate ipsum, excepturi at alias explicabo sapiente repudiandae, recusandae eligendi sequi assumenda fugiat ratione consequuntur aliquam inventore! Saepe, doloribus, aut.</p>
                    <button className="button button-red navigate button-center" data-nav='1'>Powrót na stronę główną</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>);
    }
});

export default AddTicket;