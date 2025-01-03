import React from 'react';

interface AuthLayoutProps {
  children: React.ReactNode;
  image: string;
  title: string;
}

export const AuthLayout: React.FC<AuthLayoutProps> = ({ children, image, title }) => {
  return (
    <div className="min-h-screen flex">
      <div className="flex-1 flex flex-col justify-center px-4 sm:px-6 lg:px-20 xl:px-24">
        <div className="mx-auto w-full max-w-sm lg:w-96">
          <h2 className="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">
            {title}
          </h2>
          {children}
        </div>
      </div>
      <div className="hidden w-1/2 lg:block relative">
        <img
          className="absolute inset-0 h-full w-full object-cover"
          src={image}
          alt="Authentication background"
        />
      </div>
    </div>
  );
};