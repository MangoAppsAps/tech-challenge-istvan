import { Booking } from "../interface/Booking";

export enum BookingFilter {
    All = 'all',
    /**
     * Show bookings that start in the future.
     */
    Future = 'future',
    /**
     * Show bookings that have ended.
     */
    Past = 'past',
}

interface IBookingFilterDetails {
    label: string;
    /**
     * A callback function that determines if a booking should be included in the filtered list.
     * If not provided, all bookings are included.
     */
    callback?: (booking: Booking) => boolean;
    /**
     * A message to display when no records are found for this filter.
     */
    noRecordMessage?: string;
}

export default <Record<BookingFilter, IBookingFilterDetails>>{
    all: {
        label: 'All bookings',
    },
    future: {
        label: 'Future bookings only',
        callback: (booking: Booking) => new Date(booking.start) > new Date(),
        noRecordMessage: 'No future bookings found.',
    },
    past: {
        label: 'Past bookings only',
        callback: (booking: Booking) => new Date(booking.end) < new Date(),
        noRecordMessage: 'No past bookings found.',
    },
};
