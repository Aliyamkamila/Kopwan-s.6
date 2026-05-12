import { render, screen } from '@testing-library/react';
import React from 'react';

jest.mock(
  'react-router-dom',
  () => ({
    BrowserRouter: ({ children }) => <div>{children}</div>,
    Routes: ({ children }) => <div>{children}</div>,
    Route: ({ path, element }) => (path === '/login' ? <div>{element}</div> : null),
    Navigate: ({ to }) => <div>Navigate to {to}</div>,
    Link: ({ children }) => <span>{children}</span>,
    useNavigate: () => jest.fn()
  }),
  { virtual: true }
);

import App from './App';

test('renders login page heading', () => {
  render(<App />);
  expect(screen.getByRole('heading', { name: 'Login' })).toBeInTheDocument();
});
