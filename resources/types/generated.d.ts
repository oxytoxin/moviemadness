declare namespace App.Services.TMDB.DTO {
    export type Movie = {
        adult: boolean | null;
        backdrop_path: string | null;
        belongs_to_collection: string | null;
        budget: number | null;
        genres: Array<any> | null;
        homepage: string | null;
        id: number;
        imdb_id: string | null;
        original_language: string;
        original_title: string;
        overview: string;
        popularity: number;
        poster_path: string | null;
        production_companies: Array<any> | null;
        production_countries: Array<any> | null;
        release_date: string;
        revenue: number | null;
        runtime: number | null;
        spoken_languages: Array<any> | null;
        status: string | null;
        tagline: string | null;
        title: string;
        video: boolean;
        vote_average: number;
        vote_count: number;
    };
    export type MovieCollection = {
        page: number;
        results: Array<Movie>;
        total_pages: number;
        total_results: number;
        dates: any | null;
    };
}
declare namespace App.Services.TMDB.Enums.Images {
    export type BackdropSize = 'w300' | 'w780' | 'w1280' | 'original';
    export type LogoSize = 'w45' | 'w92' | 'w154' | 'w185' | 'w300' | 'w500' | 'original';
    export type PosterSize = 'w92' | 'w154' | 'w185' | 'w342' | 'w500' | 'w780' | 'original';
    export type ProfileSize = 'w45' | 'w185' | 'h632' | 'original';
    export type StillSize = 'w92' | 'w185' | 'w300' | 'original';
}
