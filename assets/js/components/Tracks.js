import React, {Component} from 'react';
import { requestService } from "../api/requestService";
import matchSorter from 'match-sorter';

import ReactTable from "react-table";
import "react-table/react-table.css";

class Tracks extends Component {
    constructor() {
        super();
        this.state = { tracks: [] };
    }

    componentDidMount() {
        this.getTracks();
    }

    getTracks() {
        requestService.getTracks().then(tracks => {
            this.setState({ tracks: tracks.data.data })
        })
    }

    deleteTrack(id) {
        let answer = window.confirm('Are you sure?');
        if (answer) {
            requestService.del(id)
                .then(this.setState({ tracks: this.state.tracks.filter(track => track.id !== id) }));
        }
    }

    render() {
        const data = this.state.tracks;
        return (
            <div>
                <ReactTable
                    data={data}
                    filterable
                    columns={[
                        {
                            Header: "Singer",
                            accessor: "singer",
                            filterMethod: (filter, rows) =>
                                matchSorter(rows, filter.value, { keys: ["singer"] }),
                            filterAll: true
                        },
                        {
                            Header: "Name",
                            accessor: "name",
                            filterMethod: (filter, rows) =>
                                matchSorter(rows, filter.value, { keys: ["name"] }),
                            filterAll: true
                        },
                        {
                            Header: "Genre",
                            accessor: "genre",
                            filterMethod: (filter, rows) =>
                                matchSorter(rows, filter.value, { keys: ["genre"] }),
                            filterAll: true
                        },
                        {
                            Header: "Year",
                            accessor: "year",
                            filterMethod: (filter, rows) =>
                                matchSorter(rows, filter.value, { keys: ["year"] }),
                            filterAll: true,
                        },
                        {
                            Header: "Action",
                            filterable:false,
                            sortable: false,
                            Cell: row => (
                                <div>
                                    <button onClick={() =>this.deleteTrack(row.original.id)}>Delete</button>
                                </div>
                            )
                        }
                    ]}
                    defaultSorted={[
                        {
                            id: "singer",
                            desc: true
                        }
                    ]}
                    defaultPageSize={10}
                    className="-striped -highlight"
                />
                <br />
            </div>
        );
    }
}
export default Tracks;