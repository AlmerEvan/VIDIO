import '../App.css';

function Table({ data, columns }) {
  return (
    <div className="table-responsive">
      <table className="table table-striped table-hover">
        <thead>
          <tr>
            {columns.map((column, index) => (
              <th key={index} scope="col">{column.header}</th>
            ))}
          </tr>
        </thead>
        <tbody>
          {data.map((item) => (
            <tr key={item.id}>
              {columns.map((column, index) => (
                <td key={index}>
                  {column.format ? column.format(item[column.field]) : item[column.field]}
                </td>
              ))}
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}

export default Table;