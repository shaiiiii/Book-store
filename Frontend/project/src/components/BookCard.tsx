import React from 'react';
import { Pencil, Trash2 } from 'lucide-react';

interface BookProps {
  id: number;
  title: string;
  author: string;
  price: number;
  stock: number;
  image?: string;
  onEdit: (id: number) => void;
  onDelete: (id: number) => void;
}

export const BookCard: React.FC<BookProps> = ({
  id,
  title,
  author,
  price,
  stock,
  image,
  onEdit,
  onDelete,
}) => {
  const defaultImage = 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2730&q=80';
  let bookImage:string="";
  if(image){
    bookImage=`http://127.0.0.1:8000/storage/${image}`;
}
  return (
    <div className="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-105">
      <img
        src={bookImage || defaultImage}
        alt={title}
        className="w-full h-48 object-cover"
      />
      <div className="p-4">
        <h3 className="text-xl font-semibold text-gray-900 mb-2">{title}</h3>
        <p className="text-gray-600 mb-2">{author}</p>
        <div className="flex justify-between items-center mb-3">
          <span className="text-green-600 font-medium">${price}</span>
          <span className="text-gray-700">
            Stock: {stock}
            {stock === 0 && (
              <span className="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                Out of Stock
              </span>
            )}
          </span>
        </div>
        <div className="flex justify-between mt-4">
          <button
            onClick={() => onEdit(id)}
            className="inline-flex items-center px-3 py-2 text-sm font-medium text-yellow-700 bg-yellow-100 rounded-md hover:bg-yellow-200"
          >
            <Pencil className="w-4 h-4 mr-2" />
            Edit
          </button>
          <button
            onClick={() => onDelete(id)}
            className="inline-flex items-center px-3 py-2 text-sm font-medium text-red-700 bg-red-100 rounded-md hover:bg-red-200"
          >
            <Trash2 className="w-4 h-4 mr-2" />
            Delete
          </button>
        </div>
      </div>
    </div>
  );
};
