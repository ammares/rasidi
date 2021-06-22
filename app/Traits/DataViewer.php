<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait DataViewer
{
    public static function searchDataGrid($query, $quickSearchColumns, $export = false)
    {
        $request = app()->make('request');
        $search = $request->input('search');
        $dataOrder = $request->input('order');
        $response = [
            'draw' => $request->input('draw', 1),
            'recordsTotal' => DB::table(DB::raw("({$query->toSql()}) as sub"))
                ->mergeBindings('Illuminate\Database\Query\Builder' == get_class($query) ? $query : $query->getQuery())
                ->count(),
            'recordsFiltered' => 0,
            'aaData' => [],
        ];
        $operators = [
            'eq' => '=', 'neq' => '!=',
            'lt' => '<', 'lte' => '<=',
            'gt' => '>', 'gte' => '>=',
            'agg_eq' => '=', 'agg_neq' => '!=',
            'agg_lt' => '<', 'agg_lte' => '<=',
            'agg_gt' => '>', 'agg_gte' => '>=',
            'd_eq' => '=', 'd_neq' => '!=',
            'd_lt' => '<', 'd_lte' => '<=',
            'd_gt' => '>', 'd_gte' => '>=',
            'between' => '>=',
            'startswith' => 'like', 'endswith' => 'like', 'contains' => 'like',
            'in', 'not_in', 'empty', 'not_empty',
            'has', 'does_not_have',
            'zero' , 'one',
        ];
        // Quick Search
        if (!empty($search['value'])) {
            $query->where(function ($qry) use ($quickSearchColumns, $search) {
                foreach ($quickSearchColumns as $col) {
                    $qry->orWhere(DB::raw($col), 'like', '%' . $search['value'] . '%');
                }
            });
        }
        //Filters
        if (null != $request->input('filters') && !empty($request->filters['filter'])) {
            $filters = $request->filters['filter'];
            foreach ($filters['value'] as $filterKey => $filterValue) {
                switch ($filters['operator'][$filterKey]) {
                    case 'eq':
                    case 'neq':
                    case 'lt':
                    case 'lte':
                    case 'gt':
                    case 'gte':
                        !empty($filterValue) || ('' != $filterValue & 0 == $filterValue) ?
                            $query->where(
                                DB::raw($filters['column'][$filterKey]),
                                $operators[$filters['operator'][$filterKey]],
                                $filterValue
                            )
                            : null;
                        break;
                    case 'agg_eq':
                    case 'agg_neq':
                    case 'agg_lt':
                    case 'agg_lte':
                    case 'agg_gt':
                    case 'agg_gte':
                        !empty($filterValue) || ('' != $filterValue & 0 == $filterValue) ?
                            $query->having(
                                DB::raw($filters['column'][$filterKey]),
                                $operators[$filters['operator'][$filterKey]],
                                $filterValue
                            )
                            : null;
                        break;
                    case 'd_eq': // Date Operators
                    case 'd_neq':
                    case 'd_lt':
                    case 'd_lte':
                    case 'd_gt':
                    case 'd_gte':
                    case 'between':
                        !empty($filterValue) ?
                            $query->whereDate(
                                DB::raw($filters['column'][$filterKey]),
                                $operators[$filters['operator'][$filterKey]],
                                (string)$filterValue
                            )
                            : null;
                        break;
                    case 'startswith':
                        !empty($filterValue) ?
                            $query->where(
                                DB::raw($filters['column'][$filterKey]),
                                $operators[$filters['operator'][$filterKey]],
                                (string)$filterValue . '%'
                            )
                            : null;
                        break;
                    case 'endswith':
                        !empty($filterValue) ?
                            $query->where(
                                DB::raw($filters['column'][$filterKey]),
                                $operators[$filters['operator'][$filterKey]],
                                '%' . (string)$filterValue
                            )
                            : null;
                        break;
                    case 'contains':
                        !empty($filterValue) ?
                            $query->where(
                                DB::raw($filters['column'][$filterKey]),
                                $operators[$filters['operator'][$filterKey]],
                                '%' . (string)$filterValue . '%'
                            )
                            : null;
                        break;
                    case 'in':
                        !empty($filterValue) ? $query->whereIn(
                            DB::raw($filters['column'][$filterKey]),
                            $filterValue
                        ) : null;
                        break;
                    case 'not_in':
                        !empty($filterValue) ? $query->whereNotIn(
                            DB::raw($filters['column'][$filterKey]),
                            $filterValue
                        ) : null;
                        break;
                    case 'empty':
                        $query->whereNull(DB::raw($filters['column'][$filterKey]));
                        break;
                    case 'not_empty':
                        $query->whereNotNull(DB::raw($filters['column'][$filterKey]));
                        break;
                    case 'has':
                        $query->has((string)DB::raw($filters['column'][$filterKey]));
                        break;
                    case 'does_not_have':
                        $query->doesntHave((string)DB::raw($filters['column'][$filterKey]));
                        break;
                    case 'zero':
                        $query->where(DB::raw($filters['column'][$filterKey]),'=',0);   
                        break;
                    case 'one':
                        $query->where(DB::raw($filters['column'][$filterKey]),'=',1);
                        break;
                }
            }
        }
        $response['recordsFiltered'] = DB::table(DB::raw("({$query->toSql()}) as sub"))
            ->mergeBindings('Illuminate\Database\Query\Builder' == get_class($query) ? $query : $query->getQuery())
            ->count();

        //Order By
        if (!empty($dataOrder)) {
            foreach ($dataOrder as $order) {
                $query->orderBy($request->columns[$order['column']]['data'], $order['dir']);
            }
        }
        !$export ? $query->skip($request->input('start', 0))->take($request->input('length', 10)) : false;
        $response['aaData'] = $query->get();

        return $response;
    }
}
