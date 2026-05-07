import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

const Inspections = () => {
  const [inspections, setInspections] = useState([]);
  const [loading, setLoading] = useState(true);
  const navigate = useNavigate();

  useEffect(() => {
    const token = localStorage.getItem('token');
    if (!token) {
      navigate('/login');
      return;
    }

    fetchInspections(token);
  }, [navigate]);

  const fetchInspections = async (token) => {
    try {
      const response = await axios.get(
        `${process.env.REACT_APP_API_URL}/inspections`,
        { headers: { Authorization: `Bearer ${token}` } }
      );
      setInspections(response.data.data.data);
    } catch (err) {
      console.error('Error fetching inspections:', err);
    } finally {
      setLoading(false);
    }
  };

  const handleLogout = () => {
    localStorage.removeItem('token');
    navigate('/login');
  };

  return (
    <div style={{ padding: '20px' }}>
      <div style={{ display: 'flex', justifyContent: 'space-between', marginBottom: '20px' }}>
        <h2>Inspections</h2>
        <button onClick={handleLogout} style={{ padding: '10px 20px', backgroundColor: '#dc3545', color: 'white', border: 'none', borderRadius: '4px', cursor: 'pointer' }}>
          Logout
        </button>
      </div>

      {loading ? (
        <p>Loading...</p>
      ) : inspections.length === 0 ? (
        <p>No inspections found</p>
      ) : (
        <table style={{ width: '100%', borderCollapse: 'collapse', border: '1px solid #ddd' }}>
          <thead>
            <tr style={{ backgroundColor: '#f8f9fa' }}>
              <th style={{ padding: '10px', textAlign: 'left', borderBottom: '1px solid #ddd' }}>ID</th>
              <th style={{ padding: '10px', textAlign: 'left', borderBottom: '1px solid #ddd' }}>Asset ID</th>
              <th style={{ padding: '10px', textAlign: 'left', borderBottom: '1px solid #ddd' }}>Date</th>
              <th style={{ padding: '10px', textAlign: 'left', borderBottom: '1px solid #ddd' }}>Status</th>
            </tr>
          </thead>
          <tbody>
            {inspections.map((inspection) => (
              <tr key={inspection.id}>
                <td style={{ padding: '10px', borderBottom: '1px solid #ddd' }}>{inspection.id}</td>
                <td style={{ padding: '10px', borderBottom: '1px solid #ddd' }}>{inspection.asset_id}</td>
                <td style={{ padding: '10px', borderBottom: '1px solid #ddd' }}>{inspection.inspection_date}</td>
                <td style={{ padding: '10px', borderBottom: '1px solid #ddd' }}>{inspection.status}</td>
              </tr>
            ))}
          </tbody>
        </table>
      )}
    </div>
  );
};

export default Inspections;