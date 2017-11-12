<?php

namespace App\Http\Controllers\Admin\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PposCreateRequest;
use App\Http\Requests\PposUpdateRequest;
use App\Repositories\Contracts\Admin\PposRepository;
use App\Repositories\Validators\Admin\PposValidator;


class PposController extends Controller
{

    /**
     * @var PposRepository
     */
    protected $repository;

    /**
     * @var PposValidator
     */
    protected $validator;

    public function __construct(PposRepository $repository, PposValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $ppos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $ppos,
            ]);
        }

        return view('ppos.index', compact('ppos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PposCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PposCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $ppo = $this->repository->create($request->all());

            $response = [
                'message' => 'Ppos created.',
                'data'    => $ppo->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ppo = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $ppo,
            ]);
        }

        return view('ppos.show', compact('ppo'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $ppo = $this->repository->find($id);

        return view('ppos.edit', compact('ppo'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PposUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(PposUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $ppo = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Ppos updated.',
                'data'    => $ppo->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Ppos deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Ppos deleted.');
    }
}
