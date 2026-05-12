import React, { useState, useEffect, useCallback } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

const API_URL = 'https://kopwan-s6-production.up.railway.app/api';

const Inspections = () => {
  const [inspections, setInspections] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const navigate = useNavigate();

  const fetchInspections = useCallback(async (token) => {
    try {
      const response = await axios.get(
        `${API_URL}/inspections`,
        { headers: { Authorization: `Bearer ${token}` } }
      );
      setInspections(response.data.data.data);
    } catch (err) {
      if (err.response?.status === 401) {
        localStorage.removeItem('token');
        navigate('/login');
        return;
      }
      setError(err.response?.data?.message || 'Failed to load inspections.');
    } finally {
      setLoading(false);
    }
  }, [navigate]);

  useEffect(() => {
    const token = localStorage.getItem('token');
    if (!token) {
      navigate('/login');
      return;
    }

    fetchInspections(token);
  }, [fetchInspections, navigate]);

  const handleLogout = () => {
    localStorage.removeItem('token');
    navigate('/login');
  };

  return (
    <div style={{ padding: '20px', maxWidth: '1000px', margin: '0 auto' }}>
      <div style={{ display: 'flex', justifyContent: 'space-between', marginBottom: '20px', gap: '12px', flexWrap: 'wrap' }}>
        <h2>Inspections</h2>
        <button onClick={handleLogout} style={{ padding: '10px 20px', backgroundColor: '#dc3545', color: 'white', border: 'none', borderRadius: '4px', cursor: 'pointer' }}>
          Logout
        </button>
      </div>

      {loading ? (
        <p>Loading...</p>
      ) : error ? (
        <p style={{ color: '#dc3545' }}>{error}</p>
      ) : inspections.length === 0 ? (
        <p>No inspections found</p>
      ) : (
        <div style={{ overflowX: 'auto' }}>
          <table style={{ width: '100%', borderCollapse: 'collapse', border: '1px solid #ddd', minWidth: '600px' }}>
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
        </div>
      )}
    </div>
  );
};

export default Inspections;
