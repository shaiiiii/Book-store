import React from 'react';

interface StatusBadgeProps {
    status: 'issued' | 'returned' | 'overdue';
}

export const StatusBadge: React.FC<StatusBadgeProps> = ({ status }) => {
    const styles = {
        issued: 'bg-blue-100 text-blue-800',
        returned: 'bg-green-100 text-green-800',
        overdue: 'bg-red-100 text-red-800',
    };

    return (
        <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${styles[status]}`}>
      {status.charAt(0).toUpperCase() + status.slice(1)}
    </span>
    );
};
