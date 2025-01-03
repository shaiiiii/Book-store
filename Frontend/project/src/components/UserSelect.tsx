import React from 'react';
import { User } from '../api/users';

interface UserSelectProps {
    users: User[];
    value: string;
    onChange: (e: React.ChangeEvent<HTMLSelectElement>) => void;
}

export const UserSelect: React.FC<UserSelectProps> = ({ users, value, onChange }) => {
    return (
        <div>
            <label className="block text-sm font-medium text-gray-700">Select User</label>
            <select
                name="user_id"
                required
                value={value}
                onChange={onChange}
                className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            >
                <option value="">Select a user</option>
                {users.map((user) => (
                    <option key={user.id} value={user.id}>
                        {user.name} ({user.email})
                    </option>
                ))}
            </select>
        </div>
    );
};
