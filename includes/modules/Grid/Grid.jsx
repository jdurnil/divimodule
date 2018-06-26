// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';


class GridParent extends Component {

  static slug = 'dgr_grid';

  getColString(numCols){
		let colString = '';
		for( let i=1; i<= numCols; i++){
			colString += 'auto ';
		}
		return colString;
  }

  getRowString(numRows) {
	  let rowString = '';
	  for (let i = 1; i <= numRows; i++) {
		  if (i !== numRows) {
			  rowString += 'auto ';
		  } else {
			  rowString += 'auto';
		  }
	  }
	  return rowString;
  }

  render() {

  	const colString = this.getColString(parseInt(this.props.num_cols));
  	const rowString = this.getRowString(parseInt(this.props.num_rows));
  	const mainStyle = {
  		gridTemplateColumns: colString,
		gridTemplateRows: rowString,
		height: this.props.height,
		gridGap: this.props.gap
	};
    return (
		<div className="main" style={mainStyle}>
			{this.props.content}
		</div>
    );
  }
}

export default GridParent;
