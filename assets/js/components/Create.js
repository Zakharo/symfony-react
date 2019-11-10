import React, { Component } from 'react';
import { requestService } from '../api/requestService'

export default class Create extends Component {
    constructor(props) {
        super(props);
        this.onChangeSinger = this.onChangeSinger.bind(this);
        this.onChangeName = this.onChangeName.bind(this);
        this.onChangeGenre = this.onChangeGenre.bind(this);
        this.onChangeYear = this.onChangeYear.bind(this);
        this.onSubmit = this.onSubmit.bind(this);

        this.state = {
            singer: '',
            name: '',
            genre:'',
            year:''
        }
    }
    onChangeSinger(e) {
        this.setState({
            singer: e.target.value
        });
    }
    onChangeName(e) {
        this.setState({
            name: e.target.value
        })
    }
    onChangeGenre(e) {
        this.setState({
            genre: e.target.value
        })
    }
    onChangeYear(e) {
        this.setState({
            year: e.target.value
        })
    }

    onSubmit(e) {
        e.preventDefault();

        let bodyFormData = new FormData();
        bodyFormData.set('singer', this.state.singer);
        bodyFormData.set('name', this.state.name);
        bodyFormData.set('genre', this.state.genre);
        bodyFormData.set('year', this.state.year);

        requestService.create(bodyFormData)
            .then(res => console.log(res.data));

        this.setState({
            singer: '',
            name: '',
            genre: '',
            year: ''
        })
    }

    render() {
        return (
            <div style={{ marginTop: 10 }}>
                <h3>Add New Track</h3>
                <form onSubmit={this.onSubmit}>
                    <div className="form-group">
                        <label>Singer:  </label>
                        <input
                            type="text"
                            className="form-control"
                            value={this.state.singer}
                            onChange={this.onChangeSinger}
                        />
                    </div>
                    <div className="form-group">
                        <label>Name: </label>
                        <input type="text"
                               className="form-control"
                               value={this.state.name}
                               onChange={this.onChangeName}
                        />
                    </div>
                    <div className="form-group">
                        <label>Genre: </label>
                        <input type="text"
                               className="form-control"
                               value={this.state.genre}
                               onChange={this.onChangeGenre}
                        />
                    </div>
                    <div className="form-group">
                        <label>Year: </label>
                        <input type="number"
                               className="form-control"
                               value={this.state.year}
                               onChange={this.onChangeYear}
                        />
                    </div>
                    <div className="form-group">
                        <input type="submit" value="Create" className="btn btn-primary"/>
                    </div>
                </form>
            </div>
        )
    }
}