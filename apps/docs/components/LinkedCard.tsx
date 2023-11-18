// LinkedCard.tsx
import React from 'react';
import Link from 'next/link';
import cn from 'classnames';

interface LinkedCardProps extends React.ComponentProps<typeof Link> {
  children: React.ReactNode;
}

const LinkedCard: React.FC<LinkedCardProps> = ({ className, children, ...props }) => (
  <Link {...props} passHref>
    <div className={cn(
      'flex w-full flex-col items-center rounded-xl border bg-card p-6 text-card-foreground shadow transition-colors hover:bg-muted/50 sm:p-10',
      className
    )}>
      {children}
    </div>
  </Link>
);

export default LinkedCard;
